--trigger 1  Modifier Nombre Ensei
CREATE OR REPLACE FUNCTION AjoutEnseignantFunction() 
RETURNS TRIGGER 
AS 
$$
BEGIN
    IF (TG_OP = 'INSERT') THEN
        UPDATE Etablissements 
             SET "Nbr_enseignants" = "Nbr_enseignants" + 1
            WHERE id = NEW."Etablissement";
            
    ELSIF (TG_OP = 'UPDATE' )THEN
        IF ( NEW."Etablissement" <> OLD."Etablissement" ) THEN
            UPDATE Etablissements 
                SET "Nbr_enseignants" = "Nbr_enseignants" + 1
                WHERE id = NEW."Etablissement";

                UPDATE Etablissements 
                SET "Nbr_enseignants" = "Nbr_enseignants" - 1
                WHERE id = OLD."Etablissement";
                
            
        END IF;
 ELSE
     UPDATE Etablissements 
     SET "Nbr_enseignants" = "Nbr_enseignants" - 1
    WHERE id = OLD."Etablissement";
   
    END IF;
	
	return NEW;
    
   
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER AjoutEnseignantTrigger
AFTER INSERT OR UPDATE OF "Etablissement" OR DELETE 
ON enseignants
FOR EACH ROW
EXECUTE FUNCTION AjoutEnseignantFunction();


--trigger 2  when valider intervention => insert / update paiments
CREATE OR REPLACE FUNCTION AjoutFunctiontrigger() 
RETURNS TRIGGER
AS 
$$
declare
 nbr_h double precision ;
 charge_S double precision;
 dif double precision;
 h_s double precision;
BEGIN

  charge_S = charge_S(NEW."id_Intervenant");
  nbr_h = Charge_Prof(NEW."id_Intervenant",NEW."id_Etab", NEW."Annee_univ");
  h_s  = PaiementH(NEW."id_Intervenant");
IF Type_Invervention(NEW."id_Intervenant",NEW."id_Etab") = 1 THEN  --origine
  dif = nbr_h - charge_S;
  if dif > 0 then 
  CALL Ajouter_Paiment(NEW."id_Intervenant",NEW."id_Etab",dif,charge_S,NEW."Annee_univ",
NEW."Semestre");
 END IF ;
  
ELSE  -- vacation 
CALL Ajouter_Paiment(NEW."id_Intervenant",NEW."id_Etab",nbr_h,charge_S,NEW."Annee_univ",NEW."Semestre");
END IF;
RETURN NEW;
    
END; $$LANGUAGE plpgsql;
CREATE TRIGGER AjoutPaimenttrigger
AFTER UPDATE OF visa_uae ON interventions
FOR EACH ROW
WHEN (NEW.visa_uae = 1)
EXECUTE FUNCTION AjoutFunctiontrigger();


--FUNCTIONS 



create or replace function Type_Invervention(id_en bigint ,id_et bigint)
   returns int 
   language plpgsql
  as
$$
declare 
etb int ;
begin

  select "Etablissement" into etb 
  from enseignants 
  where id = id_en ; 

   if etb <> id_et then 
      return 2 ;  --vacation --
    else 
      return 1 ; --origine--
    end if;
end;
$$;




 --comment
create or replace procedure Ajouter_Paiment(id_i bigint, etb bigint , nbr_h double precision ,t_h double precision ,a_n varchar, s varchar)
   language plpgsql
  as
$$
BEGIN
IF Chercher_dejaP(id_i,etb,a_n) = false THEN
 INSERT INTO paiements ("id_Intervenant","id_Etab","VH","Taux_H","Annee_univ", "Semestre")
                VALUES (id_i,etb,nbr_h,t_h,a_n,s);
else
   
     update paiements 
     set "VH" = nbr_h 
     where "id_Intervenant" = id_i and "id_Etab" = etb and "Annee_univ" = a_n;
  
end if ;
end;
$$;



create or replace function Chercher_dejaP( id_i bigint, etb bigint, an varchar)
   returns BOOLEAN 
   language plpgsql
as
$$
declare 
begin
PERFORM "id_Intervenant" from paiements
where "id_Intervenant" = id_i and  "id_Etab" = etb and "Annee_univ" = an;

if not found then
return false ;
else 
 return true ;
end if ;

end;
$$;


create or replace function Charge_Prof(id bigint , etb bigint, an varchar)
  returns double precision
   language plpgsql
  as
$$
declare 
nbr_h int ; 
begin 
  
  select SUM("Nbr_heures") into nbr_h 
   from interventions 
 where "id_Intervenant" = id and "id_Etab" = etb and visa_uae = 1 and visa_etb = 1 and "Annee_univ" = an;
return   nbr_h ; 

end;
$$;



create or replace function Charge_S(ens bigint)
  returns double precision
   language plpgsql
  as
$$
declare 
ch_s double precision ; 
begin 
  
  select charge_statutaire into ch_s
   FROM grades G,enseignants E
   WHERE G."id_Grade" = E."id_Grade" and E.id =ens ;
return   ch_s ; 
end;
$$;



create or replace function PaiementH(ens bigint)
  returns double precision
   language plpgsql
  as
$$
declare 
h_s double precision ; 
begin 
  
  select "Taux_horaire_Vocation" 
  into h_s
    FROM grades G,enseignants E
   WHERE G."id_Grade" = E."id_Grade" and E.id =ens ;
return   h_s ; 
end;
$$;

--trigger 3  when annuler l'intervention update/delete paiments

CREATE OR REPLACE FUNCTION Modifiertrigger() 
RETURNS TRIGGER
AS 
$$
declare
 nbr_h double precision ;
 charge_S double precision;
 res  double precision;
BEGIN
  nbr_h = Charge_Prof(OLD."id_Intervenant",OLD."id_Etab", NEW."Annee_univ");
  IF Type_Invervention(OLD."id_Intervenant",OLD."id_Etab") = 1 THEN  --origine
  charge_S = charge_S(OLD."id_Intervenant");
  if nbr_h > charge_S  then
  res = nbr_h - charge_S ;
  CALL Update_Paiment(OLD."id_Intervenant",OLD."id_Etab",res, NEW."Annee_univ");
  else 
  CALL Delete_Paiment(OLD."id_Intervenant",OLD."id_Etab", NEW."Annee_univ" );
  END IF ;
  ELSE                                   -- vacation
  if nbr_h > 0 then 
  CALL Update_Paiment(OLD."id_Intervenant",OLD."id_Etab", nbr_h, NEW."Annee_univ");
  else 
  CALL Delete_Paiment(OLD."id_Intervenant",OLD."id_Etab", NEW."Annee_univ");
  END IF ;
END IF;
RETURN NEW;
    
END; $$LANGUAGE plpgsql;


CREATE TRIGGER ModifierPaimenttrigger
AFTER UPDATE OF visa_uae OR DELETE ON interventions
FOR EACH ROW
WHEN (OLD.visa_uae = 1)
EXECUTE FUNCTION Modifiertrigger();


--PROCEDURE 

Create or replace procedure Delete_Paiment(id_i bigint, etb bigint, an varchar )
   language plpgsql
  as
$$
BEGIN
delete  from paiements where "id_Intervenant" = id_i and "id_Etab" = etb and "Annee_univ" = an;
end;
$$;


Create or replace procedure Update_Paiment(id_i bigint, etb bigint , nbr_h double precision , an varchar)
   language plpgsql
  as
$$
BEGIN
update paiements
set "VH"= nbr_h
where "id_Intervenant" = id_i and "id_Etab" = etb and "Annee_univ" = an;
end;
$$;

--trigger 4 when annuler (visa_etb = 0) =>  visa_uae =0

CREATE OR REPLACE FUNCTION VisaTriggerFunction()
RETURNS TRIGGER
AS
$$
BEGIN
    update interventions
    set visa_uae = 0
    where "id_Intervenant" = OLD."id_Intervenant" and "id_Etab" = OLD."id_Etab"  and "Annee_univ" = OLD."Annee_univ";
   return NEW ;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER VisaTrigger
AFTER UPDATE of visa_etb 
ON Interventions
FOR EACH ROW
WHEN (NEW.visa_etb = 0)
EXECUTE FUNCTION VisaTriggerFunction();




