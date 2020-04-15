<template>
    <div>
        <div  class="section-btn">
            <a v-on:click="seccion=1;cambiarSeccion('Personas')" class="btn btn-main" href="#">Personas</a>
            <a v-on:click="seccion=1;cambiarSeccion('Vehiculos')" class="btn btn-main" href="#">Vehiculos</a>
        </div>
        <div v-if="seccion==1">
            <div class=col-md-12>
                    
                <form id="form-list-client">
                        <legend v-text="nombreSeccion"></legend>
                
                <div class="pull-right">
                    <a class="btn btn-default-btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
                </div>
                <table class="table table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th v-for="campo in arrayCampos">{{campo}}</th>
                        </tr>
                            
                    </thead>
                    <tbody id="form-list-client-body" v-if='nombreSeccion=="Personas"'>
                        <tr v-for="persona in arrayDatosP" :key="persona.identificacion">
                            <td v-text="persona.identificacion"></td>
                            <td v-text="persona.nombre"></td>
                            <td v-text="persona.apellidos"></td>
                            <td v-text="persona.nacimiento"></td>
                            <td v-text="persona.profesion"></td>
                            <td v-text="persona.casado"></td>
                            <td v-text="persona.ingresos"></td>
                            <td v-text="getCarro(persona.identificacion)"></td>
                            <td>
                                <a title="Editar" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-edit text-primary"></i> </a>
                                <a title="Eliminar" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-trash text-danger"></i> </a>
                            
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="form-list-client-body" v-if='nombreSeccion=="Vehiculos"'>
                        <tr v-for="vehiculo in arrayDatosC" :key="vehiculo.placa">
                            <td v-text="vehiculo.placa"></td>
                            <td v-text="vehiculo.marca"></td>
                            <td v-text="vehiculo.modelo"></td>
                            <td v-text="vehiculo.puertas"></td>
                            <td v-text="vehiculo.tipo"></td>
                            <td v-text="getPersona(vehiculo.placa)"></td>
                            <td>
                                <a title="Editar" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-edit text-primary"></i> </a>
                                <a title="Eliminar" class="btn btn-default btn-sm "> <i class="glyphicon glyphicon-trash text-danger"></i> </a>
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data (){
            return {
                seccion:0,
                nombreSeccion:'',
                arrayCampos:[],
                arrayDatosP:[],
                arrayDatosC:[],
            }
        },
        methods: {
            cambiarSeccion(nombre){
                let me = this;
                me.nombreSeccion = nombre;
                if(nombre=='Personas'){
                    me.arrayCampos=["Identificacion","Nombre","Apellidos","Fecha de nacimiento","Profesion u oficio","Casado?","Ingresos","Vehiculo"];
                }
                if(nombre=='Vehiculos'){
                    me.arrayCampos=["Placa","Marca","Modelo","Puertas","Tipo","Dueño"];
                }
            },
            listarPersonas(){
                let me = this;
                axios.get('/personas').then(function(response){
                    me.arrayDatosP = response.data;
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            listarVehiculos(){
                let me = this;
                axios.get('/vehiculos').then(function(response){
                    me.arrayDatosC = response.data;
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getCarro(id){
                let data = '/personas/getCarro/' + id;
                axios.get(data).then(function(response){
                    console.log(response);
                    return response.data.placa;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            getPersona(id){
                let data = '/vehiculos/getPersona/' + id;
                axios.get(data).then(function(response){
                    console.log(response);
                    return response.data.placa;
                })
                .catch(function(error){
                    console.log(error);
                });
            }
        },
        mounted(){
            this.listarPersonas();
            this.listarVehiculos();
        }
    }
</script>