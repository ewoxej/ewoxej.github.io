const downloadButton = document.querySelector(
    '.main__download-button'
);
const shareButton = document.querySelector('.main__share-button');
const input = document.querySelector('.input');
const image = document.querySelector('.image');
const canvas = document.querySelector('.canvas');
const context = canvas.getContext('2d');

// отрисовка картинки с текстом
function draw(num) {
    const imageObj = new Image();

    const text = checkDeclension(num);

    imageObj.src = image.src;
    imageObj.crossOrigin = 'anonymous';

    imageObj.onload = function () {
        canvas.width = this.naturalWidth;
        canvas.height = this.naturalHeight;

        context.drawImage(imageObj, 0, 0);
        // стили текста
        context.fillStyle = 'white';
        context.font =
            '600 55px Microsoft Sans Serif, Arial, Helvetica';
        context.shadowColor = 'black';
        context.shadowOffsetX = 3;
        context.shadowOffsetY = 3;
        context.shadowBlur = 4;
        // вставка текста
        context.fillText(text, 13, 480);
    };
}

// обработчик скачивания
function handleDownload() {
    const link = document.createElement('a');
    link.download = 'yest-rubli';
    link.href = canvas.toDataURL('image/png;base64;');
    link.click();
    link.delete;
}

// проверка склонения
function checkDeclension(num) {
    if (num && num.length > 11) {
        return 'есть дохуя гривен?';
    }

    num = Math.abs(num);

    let text;
    const lastDigit = num % 10;
    const twoLastDigits = num % 100;

    if (
        (lastDigit === 0 && num) ||
        (lastDigit > 4 && lastDigit < 10) ||
        (num > 9 && num < 20) ||
        (twoLastDigits > 10 && twoLastDigits < 15)
    ) {
        text = `есть ${num} гривен?`;
    } else if (lastDigit === 1) {
        text = `есть ${num} гривна?`;
    } else if (lastDigit > 1 && lastDigit < 5) {
        text = `есть ${num} гривны?`;
    } else {
        text = 'есть гривны?';
    }

    return text;
}

//слушатель ввода
input.addEventListener('input', e => {
    draw(e.target.value);
});
// слушатель кнопки скачивания
downloadButton.addEventListener('click', handleDownload);

// рендер при загузке страницы
window.onload = () => draw();

shareButton.addEventListener('click', handleShare);

async function handleShare() {
    const dataUrl = canvas.toDataURL();
    const blob = await (await fetch(dataUrl)).blob();
    const filesArray = [
        new File([blob], 'rubli.png', {
            type: blob.type,
            lastModified: new Date().getTime(),
        }),
    ];
    const shareData = {
        files: filesArray,
    };
    navigator.share(shareData);
}
