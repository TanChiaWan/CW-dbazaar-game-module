/* credits to https://github.com/dr5hn/spin-a-wheel */

var game; // the game itself
var collection_img_template = accumulated_collect_day.toString();
var accumulated_collect_day_int = parseInt(accumulated_collect_day);
var gold_coin_amount_int = parseInt(gold_coin_amount);
const d = new Date();
let current_date = d.toLocaleDateString();

var canCollect = true;

if (last_collect_date == current_date) {
    canCollect = false;
}
else {
    canCollect = true;
}

if (canCollect === true && accumulated_collect_day_int == 7) {
    accumulated_collect_day_int = 0;
    collection_img_template = parseInt(accumulated_collect_day_int);
}

var gameOptions = {

    collectionPrizes: [
        d1_prize,
        d2_prize,
        d3_prize,
        d4_prize,
        d5_prize,
        d6_prize,
        d7_prize
    ],

    actualPrizes: [
        parseInt(d1_gold_coin_amount),
        parseInt(d2_gold_coin_amount),
        parseInt(d3_gold_coin_amount),
        parseInt(d4_gold_coin_amount),
        parseInt(d5_gold_coin_amount),
        parseInt(d6_gold_coin_amount),
        parseInt(d7_gold_coin_amount)
    ]
}

// once the window loads...
window.onload = function () {

    // game configuration object
    var gameConfig = {

        // render type
        type: Phaser.CANVAS,

        // game width, in pixels
        width: 1600,
        
        // game height, in pixels
        height: 690,

        // game background color
        backgroundColor: 0xd6ccc2, //colour for login-collection

        // scenes used by the game
        scene: [playGame]
    };

    // game constructor
    game = new Phaser.Game(gameConfig);

    // pure javascript to give focus to the page/frame and scale the game
    window.focus()
    resize();
    window.addEventListener("resize", resize, false);
}

// PlayGame scene
class playGame extends Phaser.Scene {

    // method to be executed when the scene preloads
    preload() { // loading assets

        this.load.image("0", "assets/login_collection/login_collection_0.png");
        this.load.image("1", "assets/login_collection/login_collection_1.png");
        this.load.image("2", "assets/login_collection/login_collection_2.png");
        this.load.image("3", "assets/login_collection/login_collection_3.png");
        this.load.image("4", "assets/login_collection/login_collection_4.png");
        this.load.image("5", "assets/login_collection/login_collection_5.png");
        this.load.image("6", "assets/login_collection/login_collection_6.png");
        this.load.image("7", "assets/login_collection/login_collection_7.png");
    }

    // method to be executed once the scene has been created
    create() {
        

        this.collection = this.add.sprite(game.config.width / 2, game.config.height / 2, collection_img_template);


        // adding the text field
        this.title = this.add.text(game.config.width / 2, 50, "Daily Login Collection", {
            font: "bold 52px Britannic",
            align: "center",
            color: "black"
        });

        this.prizeText = this.add.text(game.config.width / 2, game.config.height - 35, "Click anywhere to COLLECT!", {
            font: "bold 24px Arial",
            align: "center",
            color: "black"
        });

        // center the text
        this.title.setOrigin(0.5);
        this.prizeText.setOrigin(0.5);

        

        this.input.on("pointerdown", this.collect, this);
    }

    // function to collect the rewards
    collect() {

        if (canCollect) {

            this.prizeText.setText(gameOptions.collectionPrizes[parseInt(collection_img_template)]);

            //display next picture
            accumulated_collect_day_int += 1;
            collection_img_template = accumulated_collect_day_int.toString();
            this.collection.setTexture(collection_img_template);

            //after collect
            canCollect = false;
            last_collect_date = current_date;
            gold_coin_amount_int += gameOptions.actualPrizes[parseInt(collection_img_template)-1];
        }
        else {
            this.prizeText.setText("You have claimed today's reward!");
        }
    }
}



// pure javascript to scale the game
function resize() {
    var canvas = document.querySelector("canvas");
    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;
    var windowRatio = windowWidth / windowHeight;
    var gameRatio = game.config.width / game.config.height;
    if (windowRatio < gameRatio) {
        canvas.style.width = windowWidth + "px";
        canvas.style.height = (windowWidth / gameRatio) + "px";
    }
    else {
        canvas.style.width = (windowHeight * gameRatio) + "px";
        canvas.style.height = windowHeight + "px";
    }
}