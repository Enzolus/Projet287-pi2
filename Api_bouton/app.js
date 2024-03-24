const express = require('express');
const mysql = require('mysql');
const axios = require('axios');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors());

const db = mysql.createConnection({
  host: 'localhost',
  user: 'subina',
  password: 'Boutonsos287*',
  database: 'hearandknow',
  port: 3306
});

const TELEGRAM_TOKEN = '7084541168:AAH8ngelXJmqvV3Vzg63dtX8Mld5W90CK8U';
const TELEGRAM_CHAT_ID = '-4117506978';

app.post('/sos', (req, res) => {
  const { id_bouton } = req.body;
  db.query('SELECT id, firstname, lastname FROM users WHERE id_bouton = ?', [id_bouton], (err, result) => {
    if (err) throw err;
    if (result.length > 0) {
      const { id: utilisateur_id, firstname, lastname } = result[0];
      const date_now = new Date().toISOString().slice(0, 19).replace('T', ' ');
      const statut = "En cours";
      const vu = 0;

      db.query('INSERT INTO alertes (utilisateur_id, date, statut, vu) VALUES (?, ?, ?, ?)', [utilisateur_id, date_now, statut, vu], (err, result) => {
        if (err) throw err;

        const fullname = `${firstname} ${lastname}`;
        const message_text = `⚠️ Alerte SOS déclenchée par ${fullname}!`;
        sendTelegramMessage(TELEGRAM_CHAT_ID, message_text);

        res.json({"message": "Alerte ajoutée et notifiée"});
      });
    } else {
      res.status(404).json({"erreur": "Aucun bouton détecté"});
    }
  });
});

function sendTelegramMessage(chat_id, message) {
  const url = `https://api.telegram.org/bot${TELEGRAM_TOKEN}/sendMessage`;
  const data = { chat_id, text: message };
  axios.post(url, data);
}

app.listen(5001, () => {
  console.log('Server running on port 5001');
});
