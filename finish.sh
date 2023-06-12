#!/bin/bash

# Vérifier si le nom de la fonctionnalité est spécifié
if [ -z "$1" ]; then
  echo "Erreur : Veuillez spécifier un nom pour la fonctionnalité."
  exit 1
fi

feature_name=$1

# Terminer la fonctionnalité
git flow feature finish $feature_name


