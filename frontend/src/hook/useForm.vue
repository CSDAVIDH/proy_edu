<script>
import { ref } from "vue";
import {
    nullable,
    required,
    minString,
    maxString,
    minNumber,
    maxNumber,
    minSize,
    maxSize,
    email
} from "@/utils/validate.js";

export const useForm = (initialForm, initialRules) => {

    const form = ref(initialForm);
    const errors = ref({});
    const validate = ref(false);

    const handleChange = ({ target }) => {
        form.value = { ...form.value, [target.name]: target.value };
    }

    const handleFile = (e) => {
        form.value = { ...form.value, [e.target.name]: e.target.files[0] };
        errors.value[e.target.name] = '';
        const rules = initialRules[e.target.name];
        Object.keys(rules).map((rule) => {
            validatorForm(e, rule, rules);
        })
        if (errors.value[e.target.name] != null) {
            e.target.style.border = '1px solid red';
            setTimeout(() => {
                e.target.style.border = '1px solid #dee2e6';
            }, 2000)
        } else {
            e.target.style.border = '1px solid #dee2e6';
        }
    };

    const handleBlur = (e) => {
        handleChange(e);
        const rules = initialRules[e.target.name];
        Object.keys(rules).map((rule) => {
            validatorForm(e, rule, rules);
        })
        if (errors.value[e.target.name]) {
            e.target.style.border = '1px solid red';
            setTimeout(() => {
                e.target.style.border = '1px solid #dee2e6';
            }, 2000)
        } else {
            e.target.style.border = '1px solid #dee2e6';
        }
    }

    const handleRevalue = (formedit) => {
        form.value = { ...form.value, ...formedit };
    }

    const validatorForm = ({ target }, rule, rules) => {
        const characteres = rule.toString();
        // validacion nullable
        if (characteres === 'nullable') {
            errors.value[target.name] = nullable()
        };
        // validacion required
        if (characteres === 'required') {
            errors.value[target.name] = required(target.value)
        };
        // validcaion correo 
        if (characteres === 'email') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = email(target.value);
            }
        }
        // validacion string 
        if (characteres === 'minString') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = minString(target.value, rules[rule]);
            }
        }
        if (characteres === 'maxString') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = maxString(target.value, rules[rule]);
            }
        }
        // validacion number 
        if (characteres === 'minNumber') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = minNumber(target.value, rules[rule]);
            }
        }
        if (characteres === 'maxNumber') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = maxNumber(target.value, rules[rule]);
            }
        }
        // validacion file 
        if (characteres === 'minSize') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = minSize(target.files[0], rules[rule]);
            }
        }
        if (characteres === 'maxSize') {
            if (!errors.value[target.name]) {
                errors.value[target.name] = maxSize(target.files[0], rules[rule]);
            }
        }
    }

    const verficador = () => {
        if (Object.keys(errors.value).length == 0) {
            validate.value = true
        } else {
            let aumentador = 0;
            const limite = Object.keys(errors.value).length
            Object.keys(errors.value).map((error) => {
                if (errors.value[error] == null) {
                    aumentador = aumentador + 1;
                }
            })

            if (aumentador == limite) {
                validate.value = true;
            } else {
                validate.value = false;
            }
        }
    }


    return [form, errors, validate, verficador, handleChange, handleFile, handleBlur, handleRevalue];

}

</script>