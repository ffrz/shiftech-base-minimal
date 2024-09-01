function localeNumberToNumber(str) {
    let num = str.replace(/\./g, '');
    return parseInt(num);
}

function toLocaleNumber(num) {
    if (typeof num === 'string')
        num = Number(num);
    return num.toLocaleString('id-ID');
}