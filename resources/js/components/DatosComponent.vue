<template>

   

    <div class="container">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
            <h2>Buscar direccion</h2>
                <div class="form-inline autocomplete_map">
                    <gmap-autocomplete
                        class="form-control"
                        @place_changed="setPlace">
                    </gmap-autocomplete>
                    <button @click="addMarker" class="btn btn-primary btn-flat">Buscar</button>
                </div>
            <br/>
        </div>
        <br>
        <gmap-map ref="mapRef"
            :center="center"
            :zoom="16"
            style="width:100%;  height: 400px;"
        >
            <gmap-marker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                :draggable="true"
                @dragend="gMapFunc($event.latLng)"
                @click="center=m.position"
            ></gmap-marker>
        </gmap-map>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" @click="direccion_map=direccion" class="btn btn-primary" data-dismiss="modal">Guardar Dirección</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!--<form @submit.prevent="submit">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" v-model="fields.name" />
            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
        </div>
        
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" id="email" v-model="fields.email" />
            <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
        </div>
        
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" v-model="fields.message"></textarea>
            <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Send message</button>
    </form>-->

    
    <form @submit.prevent="submit">
    <div class="row">
            <div class="col-md-12 titulo mt-3">
                <h1>Cotizá tu Servicio</h1>
            </div>
            <!--TITULO-->
            
            
        
       
            <div class="row d-flex col-12">
                <div class=" col-3 form-group">
                    <label>Selecciona una Ciudad</label>
                    <select v-model="ciudad_servicio" class="form-control" style="width: 100%;" required>
                        <option selected></option>
                        <option v-for="ciudad in ciudades" :value="ciudad.nombre">{{ciudad.nombre}}</option>
                    </select>
                </div>
            </div>
            <!--CIUDADES-->
        

            <div class="col-12 row contenedor" v-for="(contenedor, index) in datos_contenedores.info">
                <div class="col-8">
                
                    <div class="col-12 row ">
                        <div class="col-12 row d-flex justify-content-start">
                            <label class="titulo-contenedores">Contenedores Pequeños</label>
                            <div class="form-group clearfix row">
                                <div  class="col" v-for="(pequenos,indexp) in contenedor.info.pequenos" style="text-align: center;">
                                    <img class="imagen-recipientes" :src="'img/contenedores-pequeños.png'" alt="logo-ecolomovil" style="width: 100px; margin-bottom: 10px;">
                                    <div class="custom-control custom-radio d-inline">
                                        <input @click="addContenedorPequeno(`Contenedor pequeno de ${pequenos.capacidad}`,index)" type="radio" :id="`pequeno_${index}_${indexp}`" :name="`contenedor_${index}`" :value="`${pequenos.capacidad}-${index}_${indexp}`" >
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
                                <div class="col-3" v-for="(grandes,indexg) in contenedor.info.grandes" style="text-align: center;">
                                    <img class="imagen-recipientes" :src="'img/contenedores-grandes.png'" alt="logo-ecolomovil" style="width: 100px; margin-bottom: 10px;">
                                    <div class="custom-control custom-radio d-inline">
                                        <input @click="addContenedorPequeno(`Contenedor grande de ${grandes.capacidad}`, index)" type="radio" :id="`grandes_${index}_${indexg}`" :name="`contenedor_${index}`" :value="`${grandes.capacidad}-${index}_${indexg}`">
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
                                <div class="col" v-for="(pipas,indexpi) in contenedor.info.pipas" style="text-align: center;">
                                    <img class="imagen-recipientes" :src="'img/pipa.png'" alt="logo-ecolomovil" style="width: 100px; margin-bottom: 10px;">
                                    <div class="custom-control custom-radio d-inline">
                                        <input @click="addContenedorPequeno(`Pipa de ${pipas.capacidad}`, index)" type="radio" :id="`pipas_${index}_${indexpi}`" :value="`${pipas.capacidad}`" :name="`contenedor_${index}`">
                                        <label :for="`pipas_${index}_${indexpi}`">
                                            {{ pipas.capacidad }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--PIPAS-->

                    <div class="col-12 row ">
                        <div class="col-12 row d-flex justify-content-start">
                            <label class="titulo-contenedores">Equipo Compactador con Tolvas</label>
                            <div class="form-group clearfix row">
                                <div class="col" v-for="(toolbar,indext) in contenedor.info.toolbar" style="text-align: center;">
                                    <img class="imagen-recipientes" :src="'img/tolbar.png'" alt="logo-ecolomovil" style="width: 100px; margin-bottom: 10px;">
                                    <div class="custom-control custom-radio d-inline">
                                        <input @click="addContenedorPequeno(`Tolva de ${toolbar.capacidad}`, index)" type="radio" :id="`toolbar_${index}_${indext}`" :value="`${toolbar.capacidad}`" :name="`contenedor_${index}`">
                                        <label :for="`toolbar_${index}_${indext}`">
                                            {{ toolbar.capacidad }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--TOOLBAR-->
                
                </div>
                <!--CONTENEDORES-->

                <div class="col-4 pt-4">
                    <label class="titulo-contenedores">Dias del Servicio</label>
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`lunes`,index)" type="checkbox" :id="`lunes_${index}`" :name="`lunes_${index}`">
                        <label :for="`lunes_${index}`">
                        Lunes
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`martes`,index)" type="checkbox" :id="`martes_${index}`" :name="`martes_${index}`">
                        <label :for="`martes_${index}`">
                        Martes
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`miercoles`,index)" type="checkbox" :id="`miercoles_${index}`" :name="`miercoles_${index}`">
                        <label :for="`miercoles_${index}`">
                        Miercoles
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`jueves`,index)" type="checkbox" :id="`jueves_${index}`" :name="`jueves_${index}`">
                        <label :for="`jueves_${index}`">
                        Jueves
                        </label>
                      </div>

                      <div clas="w-100" style="margin-bottom: 18px;"></div>

                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`viernes`,index)" type="checkbox" :id="`viernes_${index}`" :name="`viernes_${index}`">
                        <label :for="`viernes_${index}`">
                        Viernes
                        </label>
                      </div>
                      
                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`sabado`,index)" type="checkbox" :id="`sabado_${index}`" :name="`sabado_${index}`">
                        <label :for="`sabado_${index}`">
                        Sabado
                        </label>
                      </div>

                      <div class="icheck-primary d-inline">
                        <input @click="addDias(`domingo`,index)" type="checkbox" :id="`domingo_${index}`" :name="`domingo_${index}`">
                        <label :for="`domingo_${index}`">
                        Domingo
                        </label>
                      </div>
                        <div clas="w-100" style="margin-bottom: 18px;"></div>
                        
                        <button @click="addContenedores" type="button" class="btn-app btn-success btn-sm" ><i class="fas fa-plus-circle"></i> Agregar</button>
                        <button @click="deleteContenedor(`${index}`)" type="button" class="btn-app btn-success btn-sm" > <i class="fas fa-minus-circle"></i>Eliminar</button>
                    </div>
                </div>
                <!--DIAS-->
            
                <hr>
            </div>
            
            

    </div>

    <!--CONTENEDOREEEEEESSSS-->
        <div class="row col-12 mt-4 contenedor">
            <div class="col-12"> <h3>REGISTRO DEL CLIENTE</h3> </div>

                <div class="col-12 row">
                    <div class="form-group col-10">
                        <p>¿Cuentas con un área libre de 1.5 mts de ancho por 2 mts de profundidad para la instalación del equipo?</p>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_1" class="custom-control-input" type="radio" name="pregunta_uno" id="pregunta_uno_1" value="SI" required>
                            <label for="pregunta_uno_1" class="custom-control-label">Si</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_1" class="custom-control-input" type="radio" name="pregunta_uno" id="pregunta_dos_1" value="NO" required>
                            <label for="pregunta_dos_1" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 row">
                    <div class="form-group col-10">
                        <p>¿El área de circulación permite el tránsito y maniobra de unidades de hasta 6 mts de altura?</p>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_2" required class="custom-control-input" type="radio" name="pregunta_dos" id="pregunta_uno_2" value="SI">
                            <label for="pregunta_uno_2" class="custom-control-label">Si</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_2" required class="custom-control-input" type="radio" name="pregunta_dos" id="pregunta_dos_2" value="NO">
                            <label for="pregunta_dos_2" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 row">
                    <div class="form-group col-10">
                        <p>¿El acceso al sitio de recolección tiene un ancho de por lo menos 4.5 mts?</p>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_3" required class="custom-control-input" type="radio" name="pregunta_tres" id="pregunta_uno_3" value="SI">
                            <label for="pregunta_uno_3" class="custom-control-label">Si</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_3" required class="custom-control-input" type="radio" name="pregunta_tres" id="pregunta_dos_3" value="NO">
                            <label for="pregunta_dos_3" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 row">
                    <div class="form-group col-10">
                        <p>Generas algunos de los siguientes residuos: Escombro, Pintura, Solventes, Residuos peligrosos, madera, llantas, líquidos o Vidrio.</p>
                    </div>
                    <div class="col-2">
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_4" required class="custom-control-input" type="radio" name="pregunta_cuatro" id="pregunta_uno_4" value="SI">
                            <label for="pregunta_uno_4" class="custom-control-label">Si</label>
                        </div>
                        <div class="custom-control custom-radio d-inline">
                            <input v-model="pregunta_4"  required class="custom-control-input" type="radio" name="pregunta_cuatro" id="pregunta_dos_4" value="NO">
                            <label  for="pregunta_dos_4" class="custom-control-label">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <label for="razon_social">Razon Social</label>
                    <input v-model="razon_social" type="text" class="form-control" id="razon_social" placeholder="Razon Social" required>
                </div>
                
                <div class="form-group col-8">
                    <label for="rfc">RFC o Equivalente</label>
                    <input v-model="rfc" type="text" class="form-control" id="rfc" placeholder="RFC o Equivalente" required>
                </div>
                <div class="form-group col-4 ">
                    <label for="rfc">Tipo de Contribuyente</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="fisico" value="Fisico" name="contribuyente" checked>
                        <label v-model="tipo_contribuyente" for="fisico" class="custom-control-label">Fisico</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="moral" value="Moral" name="contribuyente">
                        <label v-model="tipo_contribuyente" for="moral" class="custom-control-label">Moral</label>
                    </div>
                </div>
                <!--REGISTRO DEL CLIENTE-->

            <div class="col-12"> <h3>DIRECCIÓN FISCAL</h3> </div>
            <div class="form-group col-4">
                <label for="calle">Calle</label>
                <input v-model="calle" type="text" class="form-control" id="calle" placeholder="Calle" required>
            </div>
            <div class="form-group col-4">
                <label for="numero">Número</label>
                <input v-model="numero" type="text" class="form-control" id="numero" placeholder="Número" required>
            </div>
            <div class="form-group col-4">
                <label for="codigo_postal">Código Postal</label>
                <input v-model="codigo_postal" type="text" class="form-control" id="codigo_postal" placeholder="Código Postal" required>
            </div>
            <div class="form-group col-4">
                <label for="colonia">Colonia</label>
                <input v-model="colonia" type="text" class="form-control" id="colonia" placeholder="Colonia" required>
            </div>
            <div class="form-group col-4">
                <label for="ciudad">Ciudad</label>
                <input v-model="ciudad" type="text" class="form-control" id="ciudad" placeholder="Ciudad" required>
            </div>
             <!--DIRECCION FISCAL-->

            <div class="col-12"> <h3>DATOS DE CONTACTO</h3> </div>
            <div class="form-group col-4">
                <label for="nombre">Nombre</label>
                <input v-model="nombre" type="text" class="form-control" id="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group col-4">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input v-model="apellido_paterno" type="text" class="form-control" id="apellido_paterno" placeholder="Apellido Paterno" required>
            </div>
            <div class="form-group col-4">
                <label for="apellido_materno">Apellido Materno</label>
                <input v-model="apellido_materno" type="text" class="form-control" id="apellido_materno" placeholder="Apellido Materno" required>
            </div>
            <div class="form-group col-4">
                <label for="email">Email</label>
                <input v-model="email" type="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group col-4">
                <label for="telefono">Télefono</label>
                <input v-model="telefono" type="text" class="form-control" id="telefono" placeholder="Télefono" required>
            </div>
            <div class="form-group col-8">
                <label for="domicilio_servicio">Domicilo de Servicio (contenedor)</label>
                <div class="col-9">
                    <input type="text" v-model="direccion_map" name="direccion_map" class="form-control" id="domicilio_servicio" disabled>
                    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#exampleModal">Mapa</button>
                    
                </div>
                
            </div>
            <div class="form-group col-4">
                <label>Comentarios</label>
                <textarea v-model="comentarios" class="form-control" rows="3" placeholder="Comentarios ..."></textarea>
            </div>
            

           
        </div>
            
        <button :disabled="bandera"  type="submit" class="btn btn-primary mt-4 btn-flat"> {{ texto_boton }} </button>
    </form>

        
    </div>
    </div>
</template>

<style>
    .pac-container { z-index: 100000; }
    .autocomplete_map input { width:80% !important; }
    .error { color: #f57f6c;}
</style>

<script>

    import {gmapApi} from 'vue2-google-maps';
    import axios from 'axios';
    
    export default {
        name: "GoogleMap",
        data(){
            return{
                center: { lat:21.1809528, lng:-86.8593652 },
                markers: [],
                places: [],
                currentPlace: null,
                counter: 0,
                jdata:"",
                ciudad_servicio:'',
                ciudades: [],
                datos_contenedores: {
                    info: []
                },
                direccion:"",
                direccion_map:"",
                mensaje_error:"",
                pequenos:[],
                grandes:[], 
                pipas:[],
                toolbar: [],
                dias:[],
                fields: {},
                errors: {},
                servicios:1,
                info_data:"",
                pregunta_1:"",
                pregunta_2:"",
                pregunta_3:"",
                pregunta_4:"",
                razon_social: "",
                rfc:"",
                tipo_contribuyente:"Fisico",
                calle:"",
                numero:"",
                codigo_postal:"",
                colonia:"",
                ciudad:"",
                nombre:"",
                apellido_paterno:"",
                apellido_materno:"",
                email:"",
                telefono:"",
                domicilio_servicio:"",
                comentarios:"",
                texto_boton: "Solicitar Cotización",
                bandera: false,
                num_contenedores : [],

            }
        },
        methods: {
            submit() {
                
                this.texto_boton='Enviando Email...';
                this.bandera=true;
                setTimeout(this.PostEnviarEmail(),1000);
               
            },
            PostEnviarEmail()
            {
                let form_correcto = this.validaciones();
                if(form_correcto)
                {
                   this.texto_boton='Enviando Email...';
                   this.bandera=true;
                   axios.post('post',{info_contenedores: this.num_contenedores,
                                        ciudad: this.ciudad_servicio,
                                        pregunta_uno: this.pregunta_1,
                                        pregunta_dos: this.pregunta_2,
                                        pregunta_tres: this.pregunta_3,
                                        pregunta_cuatro: this.pregunta_4,
                                        razon_social: this.razon_social,
                                        ciudad_servicio: this.ciudad_servicio,
                                        rfc: this.rfc,
                                        tipo_contribuyente: this.tipo_contribuyente,
                                        calle: this.calle,
                                        numero: this.numero,
                                        codigo_postal: this.codigo_postal,
                                        colonia: this.colonia,
                                        ciudad: this.ciudad,
                                        nombre: this.nombre,
                                        apellido_paterno: this.apellido_paterno,
                                        apellido_materno: this.apellido_materno,
                                        email: this.email,
                                        telefono: this.telefono,
                                        direccion_map: this.direccion_map,
                                        comentarios: this.comentarios,
                                        num_servicios: this.servicios})
                    .then((response)=>{
                        console.log(response.data);
                        // alert("todo bien");
                        this.$swal.fire({
                            icon: 'success',
                            title: 'Bien',
                            text: 'Email Enviado de Forma Correcta',
                        });

                        this.texto_boton = "Solicitar Cotización";
                        this.bandera=false;
                        location.reload();

                    })
                    .catch(error => {
                        this.$swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al tratar de enviar el email, tratar nuevamente o contactar a nuestro email o numero de telefono',
                        });

                        this.texto_boton = "Solicitar Cotización";
                        this.bandera=false;
                    });

                    

                }
            },
            gMapFunc(evnt) {
                this.jdata = {"geo": {"lat":evnt.lat(), "lng":evnt.lng()}};
                console.log(this.jdata.geo.lat);
                Vue.$geocoder.setDefaultMode('lat-lng');
                var latLngObj = {
                    lat: this.jdata.geo.lat,
                    lng: this.jdata.geo.lng
                }
                Vue.$geocoder.send(latLngObj, response => { this.direccion = response.results[0].formatted_address; });
            },

             // receives a place object via the autocomplete component
            setPlace(place) {
                this.currentPlace = place;
            },
            addMarker() {
                if (this.currentPlace) {
                    const marker = {
                        lat: this.currentPlace.geometry.location.lat(),
                        lng: this.currentPlace.geometry.location.lng()
                    };
                    Vue.$geocoder.setDefaultMode('lat-lng');
                    Vue.$geocoder.send(marker, response => {this.direccion=response.results[0].formatted_address });
                    this.markers=[];
                    this.markers.push({ position: marker });
                    this.places.push(this.currentPlace);
                    this.center = marker;
                    this.currentPlace = null;
                }
            },
            geolocate: function() {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    

                });
                
            },

            addContenedores()
            {
                // this.num_contenedores.push({
                //     dias: ["lunes","martes","miercoles"]
                // });
                // this.num_contenedores.push({
                //     dias: ["jueves","viernes","sabado"]
                // });
                // console.log(this.num_contenedores);
                this.servicios++;
                console.log(this.servicios);
                this.listaContenedores()
               
            },

            deleteContenedor(index)
            {
                // console.log("el index "+index);
                // console.log(this.animales);
                // console.log(this.animales.splice(1,1));
                this.datos_contenedores.info.splice(1, 1);
                this.num_contenedores.pop();
                this.servicios--;
                console.log(this.servicios);
            },

            listaCiudades()
            {
                let lista_ciudades = [{
                        id: 1,
                        nombre: 'CDMX'
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
                    },
                    {
                        id: 5,
                        nombre: 'Álvaro Obregón'
                    },
                    {
                        id: 6,
                        nombre: 'Azcapotzalco'
                    },
                    {
                        id: 7,
                        nombre: 'Benito Juárez'
                    },
                    {
                        id: 8,
                        nombre: 'Coyoacán'
                    },
                    {
                        id: 9,
                        nombre: 'Cuajimalpa de Morelos'
                    },
                    {
                        id: 10,
                        nombre: 'Cuauhtémoc'
                    },
                    {
                        id: 11,
                        nombre: 'Gustavo A. Madero'
                    },
                    {
                        id: 12,
                        nombre: 'Iztacalco'
                    },
                    {
                        id: 13,
                        nombre: 'Iztapalapa'
                    },
                    {
                        id: 14,
                        nombre: 'Magdalena Contreras'
                    },
                    {
                        id: 15,
                        nombre: 'Miguel Hidalgo'
                    },
                    {
                        id: 16,
                        nombre: 'Milpa Alta'
                    },
                    {
                        id: 17,
                        nombre: 'Tláhuac'
                    },
                    {
                        id: 18,
                        nombre: 'Tlalpan'
                    },
                    {
                        id: 19,
                        nombre: 'Venustiano Carranza'
                    },
                    {
                        id: 11,
                        nombre: 'Xochimilco'
                    },];
                
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

                let toolbar = [
                    {
                      capacidad: '30 m³' 
                    }
                ]

                let info_contenedores = {
                    total: this.counter,
                    info: {
                        pequenos : contenedores_pequenos,
                        grandes: contenedores_grandes,
                        pipas: pipas,
                        toolbar: toolbar
                    }
                };

                ++this.counter;

                // this.datos_contenedores.push(contenedores_pequenos, contenedores_grandes, pipas);
                this.datos_contenedores.info.push(info_contenedores);


            },
            validaciones() {

                if(this.num_contenedores.length!==this.servicios)
                {
                    this.$swal.fire({
                         icon: 'error',
                         title: 'Error',
                         text: "Favor de seleccionar los contenedores",
                     });
                     return false;
                }
                else
                {
                    for (var i = 0; i < this.servicios; i++) {

                        if(this.num_contenedores[i].contenedor.length == 0)
                        {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Favor de seleccionar el contenedor en el servicio " + (i+1),
                            });
                            return false;
                        }
                        else if(this.num_contenedores[i].dias.length == 0)
                        {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Favor de seleccionar los dias de servicio en el servicio " + (i+1),
                            });
                            return false;
                        }
                        
                    }
                }
                return true;
               

                
            },
            addContenedorPequeno(contenedor,index)
            {

                if(!this.num_contenedores[index])
                {
                    this.num_contenedores.push({
                        contenedor,
                        dias: []

                    });
                }
                else
                {
                    this.num_contenedores[index].contenedor = contenedor;
                }

                console.log(this.num_contenedores);
                
            },
            addDias(dia,index)
            {
                if(!this.num_contenedores[index])
                {
                    this.num_contenedores.push({
                        contenedor: [],
                        dias: [dia]

                    });
                }
                else
                {

                    if(this.num_contenedores[index].dias.indexOf(dia) == -1)
                    {
                        console.log(this.num_contenedores[index].dias.indexOf(dia));
                        this.num_contenedores[index].dias.push(dia);
                    }
                    else
                    {
                        let posicion = this.num_contenedores[index].dias.indexOf(dia);
                        this.num_contenedores[index].dias.splice(posicion, 1);
                    }

                    // console.log(this.num_contenedores[index].dias.length);
                    
                }

                console.log(this.num_contenedores);

            },
            addContenedorGrande(contenedor, index)
            {
                if(!this.grandes[index])
                {
                    this.grandes.push(contenedor)
                }
                else
                {
                    this.grandes[index] = contenedor;
                    console.log(this.grandes[index]);
                    console.log(this.grandes);
                }
            },
            
        
        },

        mounted() {
            this.listaCiudades(),
            this.listaContenedores(),
            this.geolocate();
            console.log('Component mounted.')
        }
    }
</script>