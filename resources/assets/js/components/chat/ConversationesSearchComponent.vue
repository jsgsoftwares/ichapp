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
          class="mb-0">
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
    <b-modal size="lg" v-model="mostrar"    ref="modal" >
         <template v-slot:modal-header="{ close }">
        <!-- Emulate built in modal header close button action -->
        <b-button size="sm" variant="outline-danger" @click="hideModal()">
            Cerrar
        </b-button>
        <h5>{{searchModal.title}}</h5>
        </template>
        <messageconversation 
        v-for="messages in messages"
        :key="messages.id"
        :receptor="messages.receptor"
        :variant="messages.variant"
        :icono="messages.imagen"
        :dialogo="messages.content"
        :hora="messages.created_at"
        
        >
        </messageconversation>
      <!--  <b-button v-b-modal.modal-multi-3 size="sm">Open Third Modal</b-button> -->
      <template v-slot:modal-footer="{ ok, cancel}">

      
        <b-button size="sm" variant="danger" @click="hideModal()">
            Cancelar
        </b-button>

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
        mostrar:false,
        text:'',
        items: [],
        fields: [
          { key: 'id', label: 'Sesion', sortable: true, sortDirection: 'desc' },
          { key: 'nip', label: 'Nip', sortable: true, class: 'text-center' },
          { key: 'cliente', label: 'Cliente', sortable: true, class: 'text-center' },
          {key: 'agente',label: 'Agente',sortable: true,class: 'text-center'},
          {key: 'detalle',label: 'Estado',sortable: true,class: 'text-center'},
          {key: 'fecha',label: 'Fecha',sortable: true,class: 'text-center'},
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
        searchModal: {
          id: 'Editar',
          title: '',
          content: ''
        },
        selected: null,
        selected_pais: null,
        selected_genero:null,
        documentos: [],
        paises:[],
        generos:[],
        intervalo:null
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
          return this.$store.state.Searchconversation;
      },
      messages()
      {
        return this.$store.state.SearchconvertationID;
      }
    },
    mounted() {    
      this.scrollBotton();
      this.totalRows = this.clientes.length
    },
    methods: {
      scrollBotton()
      {
        const el=document.querySelector('.card_style');
        el.scrollTop=el.scrollHeight;
      },
      info(item, index, button) 
      {
        this.$store.dispatch('getSearchConvertationId',item.id)
                .then(()=>{
                  //console.log('conversacion item',item)
                        this.searchModal.title='Conversacion: '+item.cliente+'->'+item.agente;
                        this.mostrar=true;
                        
                        });
               this.intervalo=setInterval(()=>
                { 
                  console.log('Actualizando conversacion '+item.id)
                  this.timerOnline(item.id);
                }, 
                40000);
                console.log('intervalo',this.intervalo);
      },
      timerOnline(id)
      {
          this.$store.dispatch('getSearchConvertationId',id)
      },
      onFiltered(filteredItems) 
      {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
        },
       
       hideModal() {
         console.log(this.intervalo);
        window.clearInterval(this.intervalo);
        this.$refs['modal'].hide()

      },
      toggleModal()
       {

        this.$refs['mymodal'].toggle('#toggle-btn')
      },
    },

  }
  
</script>



