#!/bin/bash

echo "🐳 SEFAZ É MASSA - Docker Manager"
echo ""

case "$1" in
    start)
        echo "🚀 Iniciando containers..."
        docker-compose up -d
        echo ""
        echo "✅ Containers iniciados!"
        echo ""
        echo "Backend Laravel: http://localhost:8000"
        echo "Frontend Vue.js: http://localhost:5174"
        echo ""
        echo "Use './scripts/docker.sh logs' para ver os logs"
        ;;
    stop)
        echo "🛑 Parando containers..."
        docker-compose down
        echo "✅ Containers parados!"
        ;;
    restart)
        echo "🔄 Reiniciando containers..."
        docker-compose restart
        echo "✅ Containers reiniciados!"
        ;;
    rebuild)
        echo "🔨 Reconstruindo containers..."
        docker-compose down
        docker-compose build --no-cache
        docker-compose up -d
        echo "✅ Containers reconstruídos!"
        ;;
    logs)
        if [ -z "$2" ]; then
            echo "📋 Mostrando logs de todos os containers..."
            docker-compose logs -f
        else
            echo "📋 Mostrando logs do container $2..."
            docker-compose logs -f "$2"
        fi
        ;;
    status)
        echo "📊 Status dos containers:"
        docker-compose ps
        ;;
    *)
        echo "Uso: $0 {start|stop|restart|rebuild|logs [backend|frontend]|status}"
        echo ""
        echo "Comandos:"
        echo "  start    - Iniciar containers"
        echo "  stop     - Parar containers"
        echo "  restart  - Reiniciar containers"
        echo "  rebuild  - Reconstruir containers"
        echo "  logs     - Ver logs (opcional: backend ou frontend)"
        echo "  status   - Ver status dos containers"
        exit 1
        ;;
esac

