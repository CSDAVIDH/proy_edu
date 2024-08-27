<script setup>
</script>
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Cursos</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option class="d-none" value="">Seleccione un Curso</option>
                        <option>Primer Grado</option>
                        <option>Segundo Grado</option>
                        <option>Tercer Grado</option>
                        <option>Cuarto Grado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Paralelo</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option class="d-none" value="">Seleccione un Paralelo</option>
                        <option>Alfa</option>
                        <option>Delta</option>
                        <option>Charly</option>
                        <option>Bravo</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Estudiantes</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option class="d-none" value="">Seleccione un Estudiante</option>
                        <option>Maria Rene Rojas</option>
                        <option>Jovana Calderon Calle</option>
                        <option>Katerine Loza Paucara</option>
                        <option>Jhony Peralta</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tipos de Certificados</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option class="d-none" value="">Seleccione Certificado</option>
                        <option>Boletines</option>
                        <option>Semestrales</option>
                        <option>Grados</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start py-4">
            <button class="btn btn-success">
                <span>GENERAR CERTIFICADO</span>
            </button>
        </div>

        <div class="py-4">
            <div class="certificado">
                <div class="certifado_main">
                    <h3>CERTIFICADO DE PROYECTO DE PRUEBA</h3>
                    <h1>MARIA ELENA MAMANI CHOQUE</h1>
                    <div class="firmas">
                        <div class="firma">
                            <span>Ing. Victor Rosado</span>
                        </div>
                        <div class="firma">
                            <span>Ing. Adriana Rosa</span>
                        </div>
                        <div class="firma">
                            <span>Ing. Luis Naranjo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.certificado {
    width: 90%;
    margin: 20px 5%;
}

.certifado_main {
    width: 100%;
    height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    background-image: url('../../../../assets/image/certificado.png');
    background-size: cover;
    background-repeat: no-repeat;
    /* background-position: center; */
}
.firmas{
    margin-top: 80px;
    margin-bottom: 50px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-around;
}
.firma{
    font-size: 18px;
    text-decoration: overline;
}
</style>