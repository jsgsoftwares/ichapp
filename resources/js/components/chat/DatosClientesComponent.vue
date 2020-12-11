<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Ordenar "
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="sm" :disabled="!sortBy" class="w-25">
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>



      <b-col lg="6" class="my-1">
        <b-form-group
          label="Buscar"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
            <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Buscar por.."
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Limpiar</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
        <b-form-group
          label="Por pagina"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          label-for="perPageSelect"
          class="mb-0"
        >
          <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="sm"
            :options="pageOptions"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col sm="7" md="6" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      small
      stacked="md"
      :items="clientes"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
          Ver opciones
        </b-button>
      </template>

      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
    </b-table>

    <!-- Info modal -->
    <b-modal size="lg" :id="infoModal.id" :title="infoModal.title"  ref="my-modal" >
        <div>
                             
        <b-card bg-variant="light">

            <b-row>
                <b-col>
                    <b-row>
                        <b-col>
                            <b-form-input v-model="infoModal.name" placeholder="Nombre y apellido" ></b-form-input>
                            
                        </b-col>
                        <b-col>
                            <b-form-input v-model="infoModal.last" placeholder="Nombre y apellido" ></b-form-input>
                            
                        </b-col>
                        <b-col>
                            <b-form-input type="email" v-model="infoModal.correo" placeholder="Email"></b-form-input>
                        </b-col>
                    </b-row>
                    <b-row class="p-3">
                        <b-col>
                            <label >Tipo doc.</label>
                            <b-form-select v-model="selected" :options="documentos"></b-form-select>
                        </b-col>
                        <b-col>
                            <label >Documento</label>
                            <b-form-input v-model="infoModal.nip"  :disabled='true'  placeholder="Documento"></b-form-input>
                        </b-col>
                        <b-col>
                            <label >Fecha nacimiento</label>
                            <b-form-input  v-model="infoModal.fecha" type="date"></b-form-input>
                        </b-col>
                    </b-row>
                                <b-row class="p-3">
                        <b-col>
                            <label>Pais</label>
                            <b-form-select v-model="selected_pais" :options="paises"></b-form-select>
                        </b-col>
                        <b-col>
                            <label >Genero</label>
                            <b-form-select v-model="selected_genero" :options="generos"></b-form-select>
                        </b-col>
                        <b-col>
                            <label >Profesion</label>
                            <b-form-input v-model="infoModal.profesion" placeholder="profesion"></b-form-input>
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
        </b-card>
    
        </div>
        <template v-slot:modal-footer>
          <div class="w-100">
            
              <b-button
              variant="outline-danger"
              size="sm"
              class="float-right m-2"
              @click="hideModal"
              >
              Cancelar
            </b-button>
            <b-button
              variant="outline-success"
              size="sm"
              class="float-right m-2"
              @click="resetInfoModal"
              >
              Actualizar
              </b-button>
              <b-button
              variant="outline-info"
              size="sm"
              class="float-right m-2"
              @click="enlazar"
              >
              Enlazar a usuario
              </b-button>
              
          </div>
        </template>
    </b-modal>
    
  </b-container>
  
</template>

<script>
  export default {
    props:
      {
        contact:Number
      },
    data() {
      return {
          text:'',
        items: [],
        fields: [
          { key: 'name', label: 'Nombre completo', sortable: true, sortDirection: 'desc' },
          { key: 'correo', label: 'Correo', sortable: true, class: 'text-center' },
          {key: 'nip',label: 'Identificacion',sortable: true,class: 'text-center'},
          { key: 'actions', label: 'Actions' } 
        ],
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],
        conversation_:[],
        infoModal: {
          id: 'Editar',
          title: '',
          content: ''
        },
        selected: null,
        selected_pais: null,
        selected_genero:null,
        documentos: [],
        paises:[],
        generos:[]
      }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
      clientes()
      {
          return this.$store.state.clientes;
      }
    },
    mounted() {
      // Set the initial number of items
      //this.items=this.$store.state.clientes;
      this.totalRows = this.clientes.length
      this.paises=this.$store.state.paises
      this.generos=this.$store.state.genero
      this.documentos=this.$store.state.documentos
   
     /* t */
    },
    methods: {
      info(item, index, button) {
        

        this.infoModal.title = ` ${item.name.first} ${item.name.last}`
        this.infoModal.content = JSON.stringify(item, null, 2)
        this.infoModal.id_= item.id
        this.infoModal.name= item.name.first
        this.infoModal.first= item.name.first
         this.infoModal.last= item.name.last
        this.selected=item.tipo_nip_id
        this.infoModal.nip=item.nip
        this.infoModal.correo=item.correo
        this.infoModal.fecha=item.nacimiento
        this.selected_pais=item.pais
        this.selected_genero=item.genero
        this.infoModal.profesion=item.profesion

        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
          this.infoModal.tipo_nip=this.selected;
          this.infoModal.pais=this.selected_pais;
          this.infoModal.genero=this.selected_genero;
            
              this.$store.dispatch('postCliente',this.infoModal)
              .then(()=>{
                  this.$store.dispatch('getClientes');
                  this.$refs['my-modal'].hide()
                
              });
        },
        onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
        },
        enlazar() {
          this.infoModal.tipo_nip=this.selected;
          this.infoModal.pais=this.selected_pais;
          this.infoModal.genero=this.selected_genero;
            
              this.$store.dispatch('EnlazarCliente',this.infoModal)
              .then(()=>{
                   
                  
                  this.$store.dispatch('PostInfoClientecanal',this.contact)
                  .then(()=>{
                  this.$store.dispatch('PostInfoCliente',this.contact);
                  this.$refs['my-modal'].hide();
                });
              });
      },
       hideModal() {
        this.$refs['my-modal'].hide()
      },
      toggleModal() {

        this.$refs['my-modal'].toggle('#toggle-btn')
      },
    
                   /*    this.$store.dispatch('PostInfoClientecanal',conversation);
                this.$store.dispatch('PostInfoCliente',conversation); */
    }
  }
</script>