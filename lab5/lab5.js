$(function() {
    $("#hat-selector").draggable();
    $("#eyes-selector").draggable();
    $("#nose-selector").draggable();
    $("#mouth-selector").draggable();

    // Handle the "Save Creation" button click
});

let full = false;

function fullscreen() {
    if (!full) {
        $("#full").animate({ width: screen.width, height: screen.height }, 2000);
        full = true;
    }
}

function shrinkImage() {
    if (full) {
        $("#full").animate({ width: '40%', height: '40%' }, 2000);
        full = false;
    }
}

function screenshot() {
    console.log("first");
    const captureElement = document.querySelector("#everything");
    console.log("second");
    html2canvas(captureElement).then((canvas) => {
      const imageData = canvas.toDataURL("image/png");
      console.log("third");
      const link = document.createElement("a");
      link.setAttribute("download", "screenshot.png");
      link.setAttribute("href", imageData);
      link.click();
    });
  }
