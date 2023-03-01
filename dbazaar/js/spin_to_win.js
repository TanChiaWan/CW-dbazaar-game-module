/* credits to https://github.com/dr5hn/spin-a-wheel */

var game; // the game itself
var template_path;
var selected_segmentPrizes;
var gold_coin_amount_int = parseInt(gold_coin_amount);
const d = new Date();
let current_date = d.toLocaleDateString();

var canSpin = true;

if (last_spin_date == current_date) {
    canSpin = false;
}
else {
    canSpin = true;
}

//common = blue and green segments, rare = yellow segments, epic = orange segments
var common_segmentPrizes = [
    rare_prize, 
    common_prize, 
    epic_prize, 
    common_prize, 
    common_prize, 
    rare_prize, 
    common_prize
];
var rare_segmentPrizes = [
    rare_prize, 
    common_prize, 
    epic_prize, 
    rare_prize, 
    common_prize, 
    rare_prize, 
    common_prize
];
var epic_segmentPrizes = [
    rare_prize, 
    common_prize, 
    epic_prize, 
    rare_prize, 
    common_prize, 
    epic_prize, 
    common_prize
];

if (template === "common") {
    template_path = "assets/spin_to_win/spin_wheel_common.png";
    selected_segmentPrizes = common_segmentPrizes;
}
else if (template === "rare") {
    template_path = "assets/spin_to_win/spin_wheel_rare.png";
    selected_segmentPrizes = rare_segmentPrizes;
}
else {
    template_path = "assets/spin_to_win/spin_wheel_epic.png";
    selected_segmentPrizes = epic_segmentPrizes;
}

var gameOptions = {

    // segments (prizes) placed in the wheel
    segments: 7,

    // prize names, starting from 12 o'clock going clockwise
    segmentPrizes: selected_segmentPrizes,

    // wheel rotation duration, in milliseconds
    rotationTime: 5000
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
        backgroundColor: 0xb5838d,

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

        this.load.image("spinwheel", template_path);
        this.load.image("pin", "assets/spin_to_win/wheel_pin.png");
    }

    // method to be executed once the scene has been created
    create() {

        // adding the wheel in the middle of the canvas
        this.wheel = this.add.sprite(game.config.width * 2/3, game.config.height / 2, "spinwheel");

        // adding the pin in the middle of the canvas
        this.pin = this.add.sprite(game.config.width * 2/3, game.config.height / 2, "pin");

        // adding the text field
        this.title = this.add.text(game.config.width * 2/3, 50, "Daily Spin", {
            font: "bold 52px Britannic",
            align: "center",
            color: "white"
        });

        this.prizeDesc = this.add.text(game.config.width * 0.2/3, game.config.height / 2, 
            "COMMON : " + common_prize + "\n\n\n" +
            "RARE : " + rare_prize + "\n\n\n" +
            "EPIC : " + epic_prize, {
            font: "italic 22px Arial",
            align: "left",
            color: "white"
        });

        this.prizeText = this.add.text(game.config.width * 2/3, game.config.height - 35, "Click anywhere to SPIN!", {
            font: "bold 24px Arial",
            align: "center",
            color: "white"
        });

        // center the text
        this.title.setOrigin(0.5);
        this.prizeText.setOrigin(0.5);

        // waiting for your input, then calling "spin" function
        this.input.on("pointerdown", this.spin, this);
    }

    // function to spin the wheel
    spin() {

        // can we spin the wheel?
        if (canSpin) {

            // resetting text field
            this.prizeText.setText("");

            // the wheel will spin round from 4 to 6 times. This is just coreography
            var rounds = Phaser.Math.Between(4, 6);

            // then will rotate by a random number from 0 to 360 degrees. This is the actual spin
            var degrees = Phaser.Math.Between(0, 360);

            // before the wheel ends spinning, we already know the prize according to "degrees" rotation and the number of slices
            var prize = gameOptions.segments - 1 - Math.floor(degrees / (360 / gameOptions.segments));

            // now the wheel cannot spin because it's already spinning
            canSpin = false;

            // animation tweeen for the spin: duration 5s, will rotate by (360 * rounds + degrees) degrees
            // the quadratic easing will simulate friction
            this.tweens.add({

                // adding the wheel to tween targets
                targets: [this.wheel],

                // angle destination
                angle: 360 * rounds + degrees,

                // tween duration
                duration: gameOptions.rotationTime,

                // tween easing
                ease: "Cubic.easeOut",

                // callback scope
                callbackScope: this,

                // function to be executed once the tween has been completed
                onComplete: function (tween) {
                    // displaying prize text
                    this.prizeText.setText(gameOptions.segmentPrizes[prize]);

                    if (gameOptions.segmentPrizes[prize] == epic_prize) {
                        canSpin = true;
                        gold_coin_amount_int += parseInt(epic_gold_coin_amount);
                    }
                    else if (gameOptions.segmentPrizes[prize] == rare_prize) {
                        gold_coin_amount_int += parseInt(rare_gold_coin_amount);
                    }
                    else {
                        gold_coin_amount_int += parseInt(common_gold_coin_amount);
                    }

                    last_spin_date = current_date;
                }
            });
        }
        else {
            this.prizeText.setText("You have spinned today!");
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