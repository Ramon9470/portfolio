FROM node:20-alpine

# Define o diretório de trabalho
WORKDIR /app

# Instala o Angular CLI globalmente no container
RUN npm install -g @angular/cli

# Expõe a porta 4200
EXPOSE 4200

# Comando para manter o container rodando e servindo a aplicação
CMD ["ng", "serve", "--host", "0.0.0.0"]