
let canvas;
let ctx;
let w, h;

function setup() {
  ticker = 0;
  canvas = document.querySelector("#canvas");
  ctx = canvas.getContext("2d");
  resize();
  window.addEventListener("resize", resize);
}

function resize() {
  w = canvas.width = window.innerWidth;
  h = canvas.height = window.innerHeight;
}

function draw(now) {
  requestAnimationFrame(draw);
  ctx.fillStyle = "white";
  ctx.fillRect(0, 0, w, h);
  ctx.fillStyle = "white";
  let size = 50;
  let xSpace = Math.sqrt(2 * size ** 2);
  let ySpace = xSpace / 2;
  let nrOfRows = Math.round(h / ySpace + ySpace);
  for (let col = 0; col < w / xSpace + xSpace; col++) {
    for (let row = 0; row < nrOfRows; row++) {
      let x = col * xSpace;
      let y = row * ySpace;
      let xOffset = row % 2 * xSpace / 2;
      let scaledSize = ((Math.sin(now / 1000 + row / 5) + 1) * 0.38 + 0.1) * size;
      ctx.lineWidth = scaledSize * 0.1 + 1;
      drawSquare(x + xOffset, y, scaledSize);
    }
  }
}

function drawSquare(x, y, size) {
  ctx.save();
  ctx.translate(x, y);
  ctx.rotate(Math.PI / 4);
  // ctx.strokeStyle = "#fff";
  ctx.strokeRect(-size / 2, -size / 2, size, size);

  ctx.restore();
}

setup();
draw(1);