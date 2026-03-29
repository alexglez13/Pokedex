    const carasDado = ['', '⚀', '⚁', '⚂', '⚃', '⚄', '⚅'];

    // Estado de la batalla
    let pokemonJugador = null;
    let pokemonCPU     = null;
    let rondaActual    = 0;
    let puntosJugador  = 0;
    let puntosCPU      = 0;
    const MAX_RONDAS   = 3;

    // ─── Selección del jugador ───────────────────────────────────────
    function seleccionarPokemon(id, nombre, imagen, tipo, region, legendario) {
        pokemonJugador = { id, nombre, imagen, tipo, region, legendario };

        // CPU elige uno aleatorio distinto al del jugador
        const opciones = todosLosPokemon.filter(p => p.id_poke != id);
        pokemonCPU = opciones[Math.floor(Math.random() * opciones.length)];

        reiniciarBatalla();

        // Mostrar datos en el modal
        document.getElementById('imgJugador').src    = 'assets/img/' + pokemonJugador.imagen;
        document.getElementById('nombreJugador').textContent = pokemonJugador.nombre;
        document.getElementById('imgCPU').src        = 'assets/img/' + pokemonCPU.imagen;
        document.getElementById('nombreCPU').textContent     = pokemonCPU.npoke;

        const modal = new bootstrap.Modal(document.getElementById('modalBatalla'));
        modal.show();
    }

    // ─── Reiniciar estado de la batalla ──────────────────────────────
    function reiniciarBatalla() {
        rondaActual   = 0;
        puntosJugador = 0;
        puntosCPU     = 0;

        document.getElementById('puntosJugador').textContent = 0;
        document.getElementById('puntosCPU').textContent     = 0;
        document.getElementById('historialRondas').innerHTML  = '';
        document.getElementById('resultadoRonda').textContent = '';
        document.getElementById('resultadoFinal').classList.add('d-none');
        document.getElementById('dadoJugador').textContent   = '🎲';
        document.getElementById('dadoCPU').textContent       = '🎲';
        document.getElementById('valorDadoJugador').textContent = '';
        document.getElementById('valorDadoCPU').textContent     = '';
        document.getElementById('btnTirar').classList.remove('d-none');
        document.getElementById('btnReintentar').classList.add('d-none');
        document.getElementById('btnTirar').disabled = false;
        document.getElementById('btnTirar').textContent = '🎲 ¡Tirar Dado!';
    }

    // ─── Tirar dado ──────────────────────────────────────────────────
    function tirarDado() {
        if (rondaActual >= MAX_RONDAS) return;

        document.getElementById('btnTirar').disabled = true;
        document.getElementById('resultadoRonda').textContent = '';

        // Animación de dado
        const dadoJ = document.getElementById('dadoJugador');
        const dadoC = document.getElementById('dadoCPU');
        dadoJ.classList.add('rolling');
        dadoC.classList.add('rolling');

        // Valores aleatorios 1-6
        const valorJ = Math.floor(Math.random() * 6) + 1;
        const valorC = Math.floor(Math.random() * 6) + 1;

        setTimeout(() => {
            dadoJ.classList.remove('rolling');
            dadoC.classList.remove('rolling');

            // Mostrar caras y números
            dadoJ.textContent = carasDado[valorJ];
            dadoC.textContent = carasDado[valorC];
            document.getElementById('valorDadoJugador').textContent = valorJ;
            document.getElementById('valorDadoCPU').textContent     = valorC;

            rondaActual++;

            // Determinar ganador de la ronda
            let textoRonda = `Ronda ${rondaActual}: `;
            let claseRonda, claseResultado;

            if (valorJ > valorC) {
                puntosJugador++;
                textoRonda  += `¡Ganaste! (${valorJ} vs ${valorC})`;
                claseRonda   = 'ronda-win';
                claseResultado = 'text-success';
                document.getElementById('resultadoRonda').textContent = '✅ ¡Ganaste esta ronda!';
            } else if (valorC > valorJ) {
                puntosCPU++;
                textoRonda  += `CPU gana (${valorJ} vs ${valorC})`;
                claseRonda   = 'ronda-lose';
                claseResultado = 'text-danger';
                document.getElementById('resultadoRonda').textContent = '❌ La CPU gana esta ronda.';
            } else {
                textoRonda  += `¡Empate! (${valorJ} vs ${valorC})`;
                claseRonda   = 'ronda-draw';
                claseResultado = 'text-warning';
                document.getElementById('resultadoRonda').textContent = '🤝 ¡Empate en esta ronda!';
            }

            // Historial
            const historial = document.getElementById('historialRondas');
            historial.innerHTML += `<span class="ronda-resultado ${claseRonda}">${textoRonda}</span> `;

            // Marcador
            document.getElementById('puntosJugador').textContent = puntosJugador;
            document.getElementById('puntosCPU').textContent     = puntosCPU;

            // Verificar si alguien ya ganó 2 (mayoría) antes de terminar las 3 rondas
            const rondasRestantes = MAX_RONDAS - rondaActual;
            const yaGanoJugador   = puntosJugador > puntosCPU + rondasRestantes;
            const yaGanoCPU       = puntosCPU > puntosJugador + rondasRestantes;

            if (rondaActual >= MAX_RONDAS || yaGanoJugador || yaGanoCPU) {
                mostrarResultadoFinal();
            } else {
                document.getElementById('btnTirar').disabled = false;
                document.getElementById('btnTirar').textContent =
                    `🎲 Ronda ${rondaActual + 1} de ${MAX_RONDAS}`;
            }

        }, 700); // duración de la animación
    }

    // ─── Resultado final ─────────────────────────────────────────────
    function mostrarResultadoFinal() {
        const divFinal = document.getElementById('resultadoFinal');
        divFinal.classList.remove('d-none', 'resultado-victoria', 'resultado-derrota', 'resultado-empate');

        let mensaje;
        if (puntosJugador > puntosCPU) {
            mensaje = `🏆 ¡${pokemonJugador.nombre} ganó la batalla! ¡Felicidades!`;
            divFinal.classList.add('resultado-victoria');
        } else if (puntosCPU > puntosJugador) {
            mensaje = `💀 ¡${pokemonCPU.npoke} de la CPU ganó! Mejor suerte la próxima.`;
            divFinal.classList.add('resultado-derrota');
        } else {
            mensaje = `🤝 ¡Empate total! Ninguno pudo con el otro.`;
            divFinal.classList.add('resultado-empate');
        }

        divFinal.textContent = mensaje;
        document.getElementById('btnTirar').classList.add('d-none');
        document.getElementById('btnReintentar').classList.remove('d-none');
    }