# ✅ **com SSL + cacert + Ably + Chat**

# 💬 Chat em Tempo Real — Laravel + Vue + Ably

Este projeto é um **backend Laravel** usado para alimentar um chat em tempo real utilizando **Ably Realtime**, consumido por um frontend Vue.

<br>

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300">
</p>

<br>

## 🚀 Sobre o Projeto

O objetivo é permitir que dois usuários se comuniquem instantaneamente usando:

- **Laravel (API backend)**
- **Vue (frontend)**
- **Ably (real-time websocket)**
- **Fetch + Token Request**
- **Mock de chat estilo WhatsApp**

O Laravel recebe as mensagens e publica no canal `chat-geral` do Ably.

---

# 🔐 Certificado SSL (cacert.pem)

Para que o PHP consiga fazer requisições HTTPS com segurança, incluí o arquivo:


cacert.pem

Esse arquivo contém uma lista atualizada de **autoridades certificadoras (CAs)** usadas para validar conexões HTTPS.

> ✔ **Eu baixei este arquivo diretamente do repositório oficial do cURL**, que fornece a lista oficial de certificados confiáveis.  
> ✔ Ele está incluído no projeto porque o Ably e outras APIs externas exigem verificação SSL correta.  
> ✔ O arquivo é utilizado automaticamente pelo PHP (via cURL) quando o Laravel usa `Http::get/post`.

---

# 📦 Instalação do Backend Laravel

```bash
composer install
cp .env.example .env
php artisan key:generate
````

Edite seu **.env** e defina:

```
ABLY_KEY=SEU-KEY-AQUI
```

Inicie o servidor:

```bash
php artisan serve
```

---

# 🔗 Endpoints da API

## 🔸 **Gerar Token do Ably**

```
GET /api/ably-token
```

Laravel usa o SDK do Ably para criar um token seguro que o frontend utiliza.

## 🔸 **Enviar mensagem**

```
POST /api/mensagens
```

Body esperado:

```json
{
  "id": "123-abc",
  "usuario": "Bruna",
  "texto": "Olá!",
  "hora": "19:52"
}
```

A API:
✔ recebe a mensagem
✔ publica no canal `chat-geral` no Ably
✔ o frontend Vue recebe em tempo real

---

# 📡 Como funciona o tempo real

O Laravel publica a mensagem assim:

```php
$ably = new AblyRest(env('ABLY_KEY'));
$canal = $ably->channels->get('chat-geral');
$canal->publish('nova-mensagem', $dados);
```

O Vue assina:

```js
canal.subscribe("nova-mensagem", msg => {
    this.handleIncomingMessage(msg.data);
});
```

Simples, rápido e eficiente!

---

# 🧹 Commits recomendados

Como organizei seus arquivos, use commits claros:

```bash
git add app/Events/NovaMensagem.php
git commit -m "Remover evento NovaMensagem não utilizado"

git add app/Http/Controllers/ChatController.php
git commit -m "Atualizar ChatController para envio via Ably SDK"

git add routes/api.php
git commit -m "Ajustar rota de mensagens para ChatController"

git add cacert.pem
git commit -m "Adicionar cacert.pem (certificados SSL do cURL)"
```

---

# 📝 Licença

Este projeto segue a licença **MIT** igual ao Laravel.
