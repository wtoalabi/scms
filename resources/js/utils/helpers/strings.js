import Vue from "vue";

export function textAvatar(text) {

}


export function separateKebab(string){
    let arrayfiedString = string.split("_");
    if(arrayfiedString.length > 1){
        return arrayfiedString.join(" ")
    }else{
        return string;
    }
}
export function flattenedSentenceFromArray(arrayOfObject, keyName) {
    let string = "";
    if (_.isNotEmpty(arrayOfObject)) {
        arrayOfObject.filter(e => e)
            .forEach(object => string += `${object[keyName]}, `);
        return string.trim().substr(0, string.length - 2);
    }
}
export function slugify(string) {
    const a = 'Ã Ã¡Ã¤Ã¢Ã£Ã¥ÄƒÃ¦Ã§Ã¨Ã©Ã«ÃªÇµá¸§Ã¬Ã­Ã¯Ã®á¸¿Å„Ç¹Ã±Ã²Ã³Ã¶Ã´Å“Ã¸á¹•Å•ÃŸÅ›È™È›Ã¹ÃºÃ¼Ã»Ç˜áºƒáºÃ¿ÅºÂ·/_,:;'
    const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
    const p = new RegExp(a.split('').join('|'), 'g')

    return string.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with 'and'
        .replace(/[^\.\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, '') // Trim - from end of text
}
