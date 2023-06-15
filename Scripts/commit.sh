
echo "État actuel du dépôt Git :"
git status
echo

echo "Ajout des fichiers au dépôt Git..."
git add .
echo


read -p "Veuillez saisir un message de commit : " commit_message
echo


echo "Effectuer le commit avec le message : \"$commit_message\""
git commit -m "$commit_message"
echo


echo "Nouvel état du dépôt Git :"
git status


# xtradh
