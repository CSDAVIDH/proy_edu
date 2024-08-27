// documentacion 
// tipos de validaciones separamos string y number => XXX
// nullable
// required
// minStringXXX
// maxStringXXXX
// minNumberXXX
// maxNumberXXXX
// minSizeXXX
// maxSizeXXXX

export const nullable = () => {
    return null;
}

export const required = (data) => {
    if (!data) {
        return 'El campo es requerido'
    } else {
        return null;
    }
}

// validacion de string 

export const minString = (data, rule) => {
    if (data.length < rule) {
        return 'El campo tiene: ' + data.length + 'caracteres debe tener como minimo ' + rule + ' caracteres';
    } else {
        return null;
    }
}

export const maxString = (data, rule) => {
    if (data.length > rule) {
        return 'El campo tiene: ' + data.length + 'caracteres debe tener como maximo ' + rule + ' caracteres';
    } else {
        return null;
    }
}

// validacion de Number 

export const minNumber = (data, rule) => {
    if (data < rule) {
        return 'El campo debe ser mayor a: ' + rule;
    } else {
        return null;
    }
}

export const maxNumber = (data, rule) => {
    if (data > rule) {
        return 'El campo debe ser menor a: ' + rule;
    } else {
        return null;
    }
}

// validacion de file 

export const minSize = (data, rule) => {
    if ((data.size / 1024) > rule) {
        return 'EL archivo tiene: ' + Math.round(data.size / 1024) + 'kb' + ' minimo ' + rule + 'kb';
    } else {
        return null;
    }
}

export const maxSize = (data, rule) => {
    if ((data.size / 1024) > rule) {
        return 'EL archivo tiene: ' + Math.round(data.size / 1024) + 'kb' + ' admitido ' + rule + 'kb';
    } else {
        return null;
    }
}

// validacion de email 
export const email = (data) => {
    const regexEmail = /^(\w+[/./-]?){1,}@[a-z]+[/.]\w{2,}$/;
    if (!regexEmail.test(data.trim())) {
        return 'El campo debe ser un correo valido'
    } else {
        return null;
    }
}

