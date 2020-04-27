<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 titulo mt-3">
                <h1>Cotizá tu Servicio</h1>
            </div>
            <!--TITULO-->

            
            

            <div class="row d-flex justify-content-end col-12">
                <div class=" col-3 form-group">
                    <label>Selecciona una Ciudad</label>
                    <select v-model="ciudad_servicio" class="form-control select2" style="width: 100%;">
                        <option></option>
                        <option v-for="ciudad in ciudades" :value="ciudad.id">{{ciudad.nombre}}</option>
                    </select>
                </div>
            </div>
            <!--CIUDADES-->
        

            <div class="col-12 row" v-for="(contenedor, index) in datos_contenedores.info">
                <div class="col-8">
                
                    <div class="col-12 row ">
                        <div class="col-12 row d-flex justify-content-start">
                            <label class="titulo-contenedores">Contenedores Pequeños</label>
                            <div class="form-group clearfix row">
                                <div  class="col" v-for="(pequenos,indexp) in contenedor.info.pequenos">
                                    <img class="imagen-recipientes" :src="'img/contenedores-pequeños.png'" alt="logo-ecolomovil" style="width: 100px;">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" :id="`pequeno_${index}_${indexp}`" :name="`contenedor_pequeno_${index}`" :value="`${pequenos.capacidad}`" >
                                        <label :for="`pequeno_${index}_${indexp}`">
                                        {{ pequenos.capacidad }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--contenedores pequeños-->
                    

                    <div class="col-12 row ">
                        <div class="col-12 row d-flex justify-content-start">
                            <label class="titulo-contenedores">Contenedores Grandes</label>
                            <div class="form-group clearfix row">
                                <div class="col-3" v-for="(grandes,indexg) in contenedor.info.grandes">
                                    <img class="imagen-recipientes" :src="'img/contenedores-grandes.png'" alt="logo-ecolomovil" style="width: 100px;">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" :id="`grandes_${index}_${indexg}`" :name="`contenedor_grande_${index}`" :value="`${grandes.capacidad}`">
                                        <label :for="`grandes_${index}_${indexg}`">
                                            {{ grandes.capacidad }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--contenedores grandes-->

                    <div class="col-12 row ">
                        <div class="col-12 row d-flex justify-content-start">
                            <label class="titulo-contenedores">Pipas</label>
                            <div class="form-group clearfix row">
                                <div class="col" v-for="(pipas,indexpi) in contenedor.info.pipas">
                                    <img class="imagen-recipientes" :src="'img/pipa.png'" alt="logo-ecolomovil" style="width: 100px;">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" :id="`pipas_${index}_${indexpi}`" :value="`${pipas.capacidad}`" :name="`contenedor_pipa_${index}`">
                                        <label :for="`pipas_${index}_${indexpi}`">
                                            {{ pipas.capacidad }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--PIPAS-->
                
                </div>
                <!--CONTENEDORES-->

                <div class="col-4 pt-4">

                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`lunes_${index}`" :name="`lunes_${index}`">
                        <label :for="`lunes_${index}`">
                        Lunes
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`martes_${index}`" :name="`martes_${index}`">
                        <label :for="`martes_${index}`">
                        Martes
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`miercoles_${index}`" :name="`miercoles_${index}`">
                        <label :for="`miercoles_${index}`">
                        Miercoles
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`jueves_${index}`" :name="`jueves_${index}`">
                        <label :for="`jueves_${index}`">
                        Jueves
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`viernes_${index}`" :name="`viernes_${index}`">
                        <label :for="`viernes_${index}`">
                        Viernes
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`sabado_${index}`" :name="`sabado_${index}`">
                        <label :for="`sabado_${index}`">
                        Sabado
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input type="checkbox" :id="`domingo_${index}`" :name="`domingo_${index}`">
                        <label :for="`domingo_${index}`">
                        Domingo
                        </label>
                      </div>
                      <br>
                      <button @click="addContenedores">Agregar</button>
                      <button @click="deleteContenedor(index)">Eliminar</button>
                    </div>
                </div>
                <!--DIAS-->
            
                <hr>
            </div>
            
            

        </div>
    </div>
</template>

<script>
    
    export default {

        data(){
            return{
                counter: 0,
                ciudad_servicio:'',
                ciudades: [],
                datos_contenedores: {
                    info: []
                },
                inputs: [{
                id: 'fruit0',
                label: 'Enter Fruit Name',
                value: '',
                }],
            }
        },
        methods: {
            addInput() {
            this.inputs.push({
                id: `fruit${++this.counter}`,
                label: 'Enter Fruit Name',
                value: '',
            });
            },

            addContenedores()
            {
                this.listaContenedores()
            },

            deleteContenedor(index)
            {
                this.datos_contenedores.info.splice(index, 1);
            },

            listaCiudades()
            {
                let lista_ciudades = [{
                        id: 1,
                        nombre: 'Mexico'
                    },
                    {
                        id: 2,
                        nombre: 'Toluca'
                    },
                    {
                        id: 3,
                        nombre: 'Estado de Mexico'
                    },
                    {
                        id: 4,
                        nombre: 'Orizaba'
                    }];
                
                this.ciudades = lista_ciudades;
            },

            listaContenedores()
            {
                
                let contenedores_pequenos = [
                    {
                        capacidad: '1.5 m³'
                    },
                    {
                        capacidad: '2 m³'
                    },
                    {
                        capacidad: '3 m³'
                    },
                    {
                        capacidad: '4 m³'
                    },
                    {
                        capacidad: '6 m³'
                    },
                ];

                let contenedores_grandes = [ 
                    {
                        capacidad: '8 m³'
                    },
                    {
                        capacidad: '16 m³'
                    },
                    {
                        capacidad: '22 m³'
                    },
                    {
                        capacidad: '28 m³'
                    },        
                ]
                    
                let pipas = [
                    {
                        capacidad: '10 m³'
                    },
                    {
                        capacidad: '15 m³'
                    },
                    {
                        capacidad: '20 m³'
                    }, 
                ]

                let info_contenedores = {
                    total: this.counter,
                    info: {
                        pequenos : contenedores_pequenos,
                        grandes: contenedores_grandes,
                        pipas: pipas
                    }
                };

                ++this.counter;

                // this.datos_contenedores.push(contenedores_pequenos, contenedores_grandes, pipas);
                this.datos_contenedores.info.push(info_contenedores);


            }
        },

        mounted() {
            this.listaCiudades(),
            this.listaContenedores(),
            console.log('Component mounted.')
        }
    }
</script>
