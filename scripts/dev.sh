#!/bin/bash

echo "🚀 Iniciando SEFAZ É MASSA - Modo Desenvolvimento"
echo ""
echo "Backend Laravel: http://localhost:8000"
echo "Frontend Vue.js: http://localhost:5174"
echo ""
echo "Para parar os servidores, pressione Ctrl+C"
echo ""

# Iniciar backend
echo "📦 Iniciando Backend Laravel..."
cd "$(dirname "$0")/.."
php artisan serve --host=0.0.0.0 --port=8000 &
BACKEND_PID=$!

# Aguardar backend iniciar
sleep 2

# Iniciar frontend
echo "🎨 Iniciando Frontend Vue.js..."
cd frontend
npm run dev &
FRONTEND_PID=$!

# Função para limpar processos ao sair
cleanup() {
    echo ""
    echo "🛑 Encerrando servidores..."
    kill $BACKEND_PID 2>/dev/null
    kill $FRONTEND_PID 2>/dev/null
    echo "✅ Servidores encerrados"
    exit 0
}

# Capturar Ctrl+C
trap cleanup INT TERM

# Aguardar
wait

