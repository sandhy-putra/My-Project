function formatInput(input) {
    // Remove all non-digit characters (except for periods)
    let value = input.value.replace(/[^0-9.]/g, '');

    // If the value is empty or just a period, do nothing
    if (!value || value === '.') {
        input.value = value;
        return;
    }

    // Convert the value to a number and then back to a string
    value = parseFloat(value).toString();

    // Format the value with commas as thousands separators
    input.value = tocurrency(value);
}

function tocurrency(number) {
    return number.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function toUppercase(input) {
    input.value = input.value.toUpperCase();
}

function toNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function toNormalNumber(number) {
    return number.toString().replace(/,/g, '');;
    
}