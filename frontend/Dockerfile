FROM node:20-alpine

WORKDIR /app

# Copiar arquivos de dependências
COPY package*.json ./

# Instalar dependências
RUN npm install

# Copiar o resto dos arquivos
COPY . .

# Expor porta
EXPOSE 5174

# Comando para iniciar o servidor de desenvolvimento
CMD ["npm", "run", "dev"]

