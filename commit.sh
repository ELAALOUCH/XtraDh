# Affiche l'état actuel du dépôt Git
echo "État actuel du dépôt Git :"
git status
echo

# Ajoute tous les fichiers modifiés ou nouveaux au dépôt Git
echo "Ajout des fichiers au dépôt Git..."
git add .
echo

# Demande à l'utilisateur de saisir le message de commit
read -p "Veuillez saisir un message de commit : " commit_message
echo

# Effectue le commit avec le message saisi par l'utilisateur
echo "Effectuer le commit avec le message : \"$commit_message\""
git commit -m "$commit_message"
echo

# Affiche l'état mis à jour du dépôt Git
echo "Nouvel état du dépôt Git :"
git status
