<template>
    <div class="container">

    <div>
            <h2>Buscar direccion</h2>
            <label>
                <div class="form-inline">
                    <gmap-autocomplete
                        class="form-control"
                        @place_changed="setPlace">
                    </gmap-autocomplete>
                    <button @click="addMarker" class="btn btn-primary btn-flat">Buscar</button>
                </div>
            </label>
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

    <!--<div class="form-inline">
                    <gmap-autocomplete
                        class="form-control"
                        @place_changed="setPlace">
                    </gmap-autocomplete>
                    <button @click="addMarker" class="btn btn-primary btn-flat">Add</button>
                </div>-->
    <!--<gmap-map ref="mapRef"
            :center="center"
            :zoom="12"
            style="width:100%;  height: 400px;"
        >
            <gmap-marker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                @click="center=m.position"
            ></gmap-marker>
        </gmap-map>-->
    
        <!--<gmap-map ref="mapRef" :center="{lat:21.1809528, lng:-86.8593652}" :zoom="17" style="width: 100%; height: 300px">
    <gmap-marker :position="{lat:21.1809528, lng:-86.8593652}" :draggable="true" @dragend="gMapFunc($event.latLng)"/>
</gmap-map>-->
        <div class="row col-10">
            <div class="col-12"> <h3>REGISTRO DEL CLIENTE</h3> </div>
            <div class="form-group col-12">
                <label for="razon_social">Razon Social</label>
                <input type="text" class="form-control" id="razon_social" placeholder="Razon Social">
            </div>
            <div class="form-group col-8">
                <label for="rfc">RFC o Equivalente</label>
                <input type="text" class="form-control" id="rfc" placeholder="RFC o Equivalente">
            </div>
            <div class="form-group col-4">
                <label for="rfc">Tipo de Contribuyente</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="fisico" name="contribuyente" checked>
                    <label for="fisico" class="custom-control-label">Fisico</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="moral" name="contribuyente">
                    <label for="moral" class="custom-control-label">Moral</label>
                </div>
            </div>
            <!--REGISTRO DEL CLIENTE-->

            <div class="col-12"> <h3>DIRECCIÓN FISCAL</h3> </div>
            <div class="form-group col-4">
                <label for="calle">Calle</label>
                <input type="text" class="form-control" id="calle" placeholder="Calle">
            </div>
            <div class="form-group col-4">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" placeholder="Número">
            </div>
            <div class="form-group col-4">
                <label for="codigo_postal">Código Postal</label>
                <input type="text" class="form-control" id="codigo_postal" placeholder="Código Postal">
            </div>
            <div class="form-group col-4">
                <label for="colonia">Colonia</label>
                <input type="text" class="form-control" id="colonia" placeholder="Colonia">
            </div>
            <div class="form-group col-4">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad">
            </div>
             <!--DIRECCION FISCAL-->

            <div class="col-12"> <h3>DATOS DE CONTACTO</h3> </div>
            <div class="form-group col-4">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
            </div>
            <div class="form-group col-4">
                <label for="apellido_paterno">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellido_paterno" placeholder="Apellido Paterno">
            </div>
            <div class="form-group col-4">
                <label for="apellido_materno">Apellido Materno</label>
                <input type="text" class="form-control" id="apellido_materno" placeholder="Apellido Materno">
            </div>
            <div class="form-group col-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group col-4">
                <label for="telefono">Télefono</label>
                <input type="text" class="form-control" id="telefono" placeholder="Télefono">
            </div>
            <div class="form-group col-6">
                <label for="domicilio_servicio">Domicilo de Servicio (contenedor)</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="domicilio_servicio" disabled>
                    <button type="submit" class="btn btn-success mt-3">Mapa</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {gmapApi} from 'vue2-google-maps';
    
    
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
                inputs: [{
                id: 'fruit0',
                label: 'Enter Fruit Name',
                value: ''
                }],
            }
        },
        methods: {
            gMapFunc(evnt) {
                this.jdata = {"geo": {"lat":evnt.lat(), "lng":evnt.lng()}};
                console.log(this.jdata.geo.lat);
                Vue.$geocoder.setDefaultMode('lat-lng');
                var latLngObj = {
                    lat: this.jdata.geo.lat,
                    lng: this.jdata.geo.lng
                }
                Vue.$geocoder.send(latLngObj, response => { console.log(response.results[0].formatted_address) });
                // var geocoder = new google.maps.Geocoder;
                // var latlng = {
                //         lat: parseFloat(this.jdata.geo.lat),
                //         lng: parseFloat(this.jdata.geo.lng)
                //     };
                // this.$refs.mapRef.$mapPromise.then(() => {

                    // geocoder.geocode({
                    //     'location': latlng 
                    //     // ej. "-34.653015, -58.674850"
                    // }, function(results, status) {
                    //     // si la solicitud fue exitosa
                    //     if (status === google.maps.GeocoderStatus.OK) {
                    //         // si encontró algún resultado.
                    //         if (results[1]) {
                    //         console.log(results[1].formatted_address);
                    //         }
                    //     }
                    // });

                //  })
                
                
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
                
            }
            
        
        },

        mounted() {
            this.geolocate();
            this.$refs.mapRef.$mapPromise.then((map) => {
            // En este punto ya tengo mi objeto map.
            })
            console.log('Component mounted.')
        }
    }
</script>