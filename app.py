from flask import Flask, request, jsonify
from flask_mysqldb import MySQL
import datetime
import requests
from flask_cors import CORS  # Importez CORS

app = Flask(__name__)
CORS(app)  # Activez CORS pour toute votre application
# Configuration de la base de données
app.config['MYSQL_HOST'] = '192.168.1.36'
app.config['MYSQL_USER'] = 'subina'
app.config['MYSQL_PASSWORD'] = 'Boutonsos287*'
app.config['MYSQL_DB'] = 'hearandknow'
app.config['MYSQL_PORT'] = 3306

mysql = MySQL(app)


# Configuration pour le bot Telegram
TELEGRAM_TOKEN = '7084541168:AAH8ngelXJmqvV3Vzg63dtX8Mld5W90CK8U'
TELEGRAM_CHAT_ID = '-4117506978'

@app.route('/sos', methods=['POST'])
def sos():
    if not request.is_json:
        return jsonify({"erreur": "La requête doit être du JSON"}), 400

    data = request.get_json()
    id_bouton = data.get('id_bouton')

    cursor = mysql.connection.cursor()
    cursor.execute('SELECT id, firstname, lastname FROM users WHERE id_bouton = %s', (id_bouton,))
    user = cursor.fetchone()

    if user:
        utilisateur_id, firstname, lastname = user
        date_now = datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        statut = "En cours"
        vu = 0

        insert_query = 'INSERT INTO alertes (utilisateur_id, date, statut, vu) VALUES (%s, %s, %s, %s)'
        cursor.execute(insert_query, (utilisateur_id, date_now, statut, vu))
        mysql.connection.commit()

        fullname = f"{firstname} {lastname}"
        message_text = f"⚠️ Alerte SOS déclenchée par {fullname}!"
        send_telegram_message(TELEGRAM_CHAT_ID, message_text)

        cursor.close()
        return jsonify({"message": "Alerte ajoutée et notifiée"}), 200
    else:
        return jsonify({"erreur": "Aucun bouton détecté"}), 404

def send_telegram_message(chat_id, message):
    url = f"https://api.telegram.org/bot{TELEGRAM_TOKEN}/sendMessage"
    data = {'chat_id': chat_id, 'text': message}
    response = requests.post(url, data=data)
    return response.json()

if __name__ == '__main__':
    app.run(debug=True, port=5001)
