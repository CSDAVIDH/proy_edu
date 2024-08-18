<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth/auth';
import { useForm } from "@/hook/useForm.vue";

const authStore = useAuthStore();
const load = ref(false);
const visible = ref('password');
const icon = ref('fa-solid fa-eye-slash');
const disabled = ref(false);

const user = {
    email: 'admin@admin.com',
    password: 'Aleph_2024',
};

const validaciones = {
    email: { required: true, email: true },
    password: { required: true, minString: 8, maxString: 200 },
};

const [
    form,
    errors,
    validate,
    verficador,
    handleChange,
    handleFile,
    handleBlur,
    handleRevalue
] = useForm(user, validaciones);

const login = async () => {
    verficador();
    if (validate.value) {
        load.value = true;
        try {
            await authStore.login(form.value)
        } catch (error) {
            console.log(error)
        }
        load.value = false
    }
}

const setvisible = () => {
    if (visible.value == 'password') {
        visible.value = 'text'
        icon.value = "fa-solid fa-eye";
        disabled.value = true;
        setTimeout(() => {
            visible.value = 'password'
            icon.value = "fa-solid fa-eye-slash";
            disabled.value = false;
        }, 3000)
    }
}


</script>
<template>
    <div class="card_login">
        <!-- <div class="card_login_header">
            <h1>LOGIN</h1>
        </div> -->
        <div class="card-body">
            <form @submit.prevent="login">
                <div class="form-group py-2">
                    <label class="form-label label_login" for="email">CORREO ELECTRONICO</label>
                    <input type="email" :value="form.email" name="email" @change="handleChange" @blur="handleBlur"
                        class="form-control input_login" placeholder="Ingrese su correo" required />
                    <p class="fs-6 text-danger" v-if="errors.email">
                        {{ errors.email }}
                    </p>
                </div>
                <div class="form-group py-2">
                    <label class="form-label label_login" for="password">CONTRASEÑA</label>
                    <div class="login_password">
                        <input :type="visible" :value="form.password" name="password" @change="handleChange"
                            @blur="handleBlur" class="form-control input_login" placeholder="**********" required />
                        <i :class="icon" @click="setvisible" :disabled="disabled"></i>
                    </div>
                    <p class="fs-6 text-danger" v-if="errors.password">
                        {{ errors.password }}
                    </p>
                </div>
                <div class="card_login_button">
                    <template v-if="load == true">
                        <button class="button_loading" disabled>
                            <i className="fa-solid fa-spinner fa-spin-pulse fa-spin-reverse"></i>
                            <span class="mx-1">Espere...</span>
                        </button>
                    </template>
                    <template v-else>
                        <button>INICIAR SESION</button>
                    </template>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
.card_login {
    width: 400px;
    border-radius: 10px;
    border: 1px solid #fff;
    display: flex;
    flex-direction: column;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 40px;
}

.card_login_header {
    width: 100%;
}

.card_login_header h1 {
    color: #fff;
    font-size: 25px;
    outline-width: bold;
    text-transform: uppercase;
    text-align: center;
}


.card_login_button {
    width: 100%;
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card_login_button button {
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #fff;
    background-color: #2b2b2b;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    transition: all 0.5s ease-in-out;
}

.card_login_button button:hover {
    background-color: rgb(3, 48, 3);
}

.button_loading {
    pointer-events: none;
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #fff;
    background-color: #2b2b2b;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
}

.label_login {
    color: #fff;
    font-weight: bold;
}

.input_login {
    background-color: transparent;
    color: #fff;
}


.login_password {
    display: flex;
    align-items: center;
}

.login_password i {
    pointer-events: all;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 38px;
    border-radius: 5px;
    background-color: transparent;
    color: #fff;
    border: 1px solid #fff;
}
</style>