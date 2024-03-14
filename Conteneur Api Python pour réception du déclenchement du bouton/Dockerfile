# Utilisez l'image officielle Python comme image de base
FROM python:3.9

# Définissez le répertoire de travail dans le conteneur
WORKDIR /app

# Copiez le fichier des dépendances dans le répertoire de travail
COPY requirements.txt .

# Installez les dépendances
RUN pip install --no-cache-dir -r requirements.txt

# Copiez le reste des fichiers de l'application dans le répertoire de travail
COPY . .

# Définissez la variable d'environnement pour Flask
ENV FLASK_APP=app.py
ENV FLASK_RUN_HOST=0.0.0.0

# Exposez le port sur lequel l'application va s'exécuter
EXPOSE 5001

# Commande pour exécuter l'application
CMD ["flask", "run", "--port=5001"]
