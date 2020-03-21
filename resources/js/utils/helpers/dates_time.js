export let days = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 1, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
export let months = [
    {id: 1, name: 'January',short:'Jan'},
    {id: 2, name: 'February',short:'Feb'},
    {id: 3, name: 'March',short: 'Mar'},
    {id: 4, name: 'April',short: 'Apr'},
    {id: 5, name: 'May',short: 'May'},
    {id: 6, name: 'June',short: 'Jun'},
    {id: 7, name: 'July',short: 'Jul'},
    {id: 8, name: 'August', short: 'Aug'},
    {id: 9, name: 'September',short: 'Sept'},
    {id: 10, name: 'October',short: 'Oct'},
    {id: 11, name: 'November',short: 'Nov'},
    {id: 12, name: 'December', short: 'Dec'},
];
export function turnDateToTimestamp(dateString) {
    return (new Date(dateString)).getTime()/1000
}
export function turnMonthIntegerToString(dateString){
    let dateArray = dateString.split('-');
    let monthInt = Number.parseInt(dateArray[1]);
    let monthString = months.find(month=> month.id === monthInt);
    dateArray[1] = monthString['short'];
    return dateArray.join('-');
}
