$(document).ready(function () {
    const canvas = document.getElementById("animacao");
    const c = canvas.getContext("2d");

    canvas.width = 1000;
    canvas.height = 600;

    const mapSize = 30;
    const scale = 3;

    const scaledCanvas = {
        width: canvas.width / scale,
        height: canvas.height / scale
    }

    const global = {
        canvas: {
            width: canvas.width,
            height: canvas.height
        },
        gravity: 0.5
    }


    const map = new Sprite({
        position: {
            x: 0,
            y: 0
        },
        imageSrc: 'bin/img/Mapa.png',
        context: c
    });

    const parseCollision = [];
    for (let i = 0; i < mapCollision.length; i += mapSize) {
        parseCollision.push(mapCollision.slice(i, i + mapSize));
    }

    const collisionBlocks = []
    parseCollision.forEach((row, y) => {
        row.forEach((symbol, x) => {
            if (symbol != 0) {
                collisionBlocks.push(new collisionBlock({
                    position: {
                        x: x*16,
                        y: y*16
                    },
                    context: c
                }))
            }
        });
    });

    const parsePlataform = [];
    for (let i = 0; i < mapPlataform.length; i += mapSize) {
        parsePlataform.push(mapPlataform.slice(i, i + mapSize));
    }

    const plataforms = []
    parsePlataform.forEach((row, y) => {
        row.forEach((symbol, x) => {
            if (symbol != 0) {
                plataforms.push(new Plataform({
                    position: {
                        x: x,
                        y: y
                    },
                    context: c
                }))
            }
        });
    });


    const player = new Player({
        position:{
            x: 100,
            y: 100
        },
        context: c,
        global: global,
        collisionBlocks: collisionBlocks
    });

    const key = {
        d: {
            pressed: false
        },
        a: {
            pressed: false
        },
        w: {
            pressed: false
        }
    }


    function animate() {
        //limpar tela
        c.clearRect(0, 0, canvas.width, canvas.height);

        //desenhar mapa
        c.save();
        c.scale(scale, scale);
        c.translate(0, -map.image.height + scaledCanvas.height);
        map.update();
        collisionBlocks.forEach((collisionBlock) => {
            collisionBlock.update();
        });
        plataforms.forEach((plataforms) => {
            plataforms.update();
        });
        player.update();
        c.restore();

        //atualizar/desenhar player

        player.velocity.x = 0;
        if(key.d.pressed && !key.a.pressed){
            player.velocity.x = 2;
        }
        else if(key.a.pressed && !key.d.pressed){
            player.velocity.x = -2;
        }


        window.requestAnimationFrame(animate)
    }
    animate();

    $(window).on("keydown", (e) => {
        switch (e.key){
            case 'd':
                key.d.pressed = true;
            break;

            case 'a':
                key.a.pressed = true;
            break;

            case 'w':
                key.w.pressed = true;
                player.velocity.y = -7;
            break;
        }
    });

    $(window).on("keyup", (e) => {
        switch (e.key){
            case 'd':
                key.d.pressed = false;
            break;

            case 'a':
                key.a.pressed = false;
            break;

            case 'w':
                key.w.pressed = false;
            break;
        }
    });
    
});
