<template>
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>


      <overlay :opened="opened" :visible="visible" @closed="opened = visible = false">
            <b-spinner label="Loading..."></b-spinner>
            Loading...
      </overlay>

      <overlay :opened="opened_" :visible="visible_" @closed="opened_ = visible_ = false">
            <center><b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow"></b-spinner></center> 
      </overlay>

    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <br />
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Users</h2>
              <p>       
                  <button
                  class="btn btn-success"
                  @click="showModal"
                >
                  <i class="feather icon-plus-circle"></i>
                  Add new
                </button>
              </p>
              
       
            </div>
            <div class="col-12">
              
              <p variant="primary">
               <h5> Subscribed users
              <b-badge variant="light">{{Uactivos}}</b-badge></h5>
              </p>
            </div>
          </div>
        </div>
        <hr class="my-4" />

        <div
          class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
        ></div>
      </div>
      <br />
      <br />
      <div class="content-body">
        <!-- Data list view starts -->
        <section id="data-list-view" class="data-list-view-header">
          <!-- DataTable starts -->
          <div class="table-responsive">
            <table class="table data-list-view" v-if="actualizadaTabla">
              <thead>
                <tr>
                  <th>STATE</th>
                  <th>NAME</th>
                  <th>USUARIO</th>
                  <th>ROL</th>
                  <th>EDIT</th>
                  <th>ACTIVE</th>
                </tr>
              </thead>
              <tbody>
                <dashusuariostabla_component
                  v-for="user in usuarios"
                  :key="user.id"
                  :name="user.name"
                  :rol="user.rol"
                  :rol_id="user.rol_id"
                  :email="user.email"
                  :estado_user="user.state"
                  :creador="user.creator"
                  :id="user.id"
                />
              </tbody>
            </table>
          </div>
          <!-- DataTable ends -->
        </section>
        <!-- Data list view end -->
      </div>
    </div>

  
     <b-modal ref="my-modal"  title="Using Component Methods" @ok="validacion">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label"
                  >Username:</label
                >
                <div class="input-group mb-3">
                  <input
                    
                    type="text"
                    v-model="username"
                    class="form-control"
                    placeholder="username"
                    aria-label="username"
                    aria-describedby="basic-addon2"
                  />
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">{{
                      companieName
                    }}</span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Name:</label>
                <input
                  type="text"
                  v-model="name"
                  
                  class="form-control"
                  id="recipient-name"
                />
              </div>

              <div class="form-group">
                <label for="message-text" class="col-form-label"
                  >Password:</label
                >
                <input
                  type="password"
                 
                  v-model="password"
                  class="form-control"
                  id="recipient-name"
                  @blur="validarPass()"
                />
                  <p v-if="passErr.length" variant="danger">
          
                    <ul>
                      <li style="color:red" v-for="error in passErr" >{{ error }}</li>
                    </ul>
                 </p>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label"
                  >Repeat Password:</label
                >
                <input
                  type="password"
                 
                  v-model="repassword"
                  class="form-control"
                  id="recipient-name"
                  @blur="validarPassMatch()"
                  
                />
                <p v-if="passErrRe.length" variant="danger">
          
                    <ul>
                      <li style="color:red" v-for="error in passErrRe" >{{ error }}</li>
                    </ul>
                 </p>
              </div>

              <div class="form-group col">
                <label for="rol-text" class="col-form-label m-2">Rol:</label>
           <!--      <div class="dropdown">
                  <button
                   
                    size="sm"
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    {{Select_rol}}
                  </button>
                  <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a
                      class="dropdown-item"
                      href="#"
                      v-for="rol_user in roles_dispacht"
                      :key="rol_user.id"
                      @click="rolselect(rol_user.id)"
                      >{{ rol_user.detalle }}</a
                    >
                  </div>
                </div> -->

                  <select id="rol-text" @change="rolselect(sortType)" v-model="sortType" class="mdb-select md-form class btn btn-outline dropdown-toggle waves-effect waves-light" searchable="Search here..">
                   
                    <option
                      v-for="rol_user in roles_dispacht"
                      :key="rol_user.id"
                      :value="rol_user.id"
                 
                      >{{ rol_user.detalle }}</option>

                  </select>
                  <p v-if="errors.length" variant="danger">
                    <b>Please correct the following error (s):</b>
                    <ul>
                      <li style="color:red" v-for="error in errors" >{{ error }}</li>
                    </ul>
                 </p>
              </div>
 
            </form>
    </b-modal>
  </div>
  <!-- END: Content-->
</template>
<script>
export default {
  data() {
    return {
      opened: true,
      visible: true,
      opened_:false,
      visible_: false,
      sortType: '5',
      actualizadaTabla:false,
      errors: [],
      passErr: [],
      passErrRe: [],
      checked: false,
      companieName: "",
      username: "",
      name: "",
      password: "",
      repassword: "",
      Select_rol: "Select rol",
        Uactivos:0,
        Upendientes:0,
      role: 0,
      state: {
        activar: true,
     
      },
    };
  },
  mounted() {
    this.role=5;
    this.UsuariosSubscritos().then(()=>{
      this.cargaInicial();
    });
   
   
  },
  methods: {
      showModal() {
        this.$refs['my-modal'].show();
      },
    UsuariosSubscritos(){
       return  this.$store.dispatch("PostUsuariosSubscritos")
      .then(() => {
        this.Uactivos=this.usuariosSubscrito.CantusuariosSubscrito;
        this.Upendientes=this.usuariosSubscrito.usuariosPendientes;
          console.log(this.usuariosSubscrito.usuariosPendientes);

      });
      
    },
    cargaInicial(){
      this.$store.dispatch("getUserCompanie_dash", this.$store.state.user_id)
      .then(() => {
          this.opened= false
          this.visible= false
          this.actualizadaTabla=true
          this.$store.dispatch("getRols_dash");
          
          this.companieName = `@${this.$store.state.companie.name}.com`;
      });    

    },
    validarPass() {
      this.passErr = [];
      if (this.password.length < 6) {
        this.passErr.push(
          "Your password should be 6 to 10 characters in length and can contain letters (A-Z, a-z), numbers (0-9) "
        );
      } else {
        this.passErr = [];
      }
    },
    validarPassMatch() {
      this.passErrRe = [];
      if (this.password != this.repassword) {
        this.passErrRe.push("Your password no match ");
      } else {
        this.passErrRe = [];
      }
    },
    rolselect(id) {
      console.log('seleccionado rol',id)
      this.role = id;
      this.$store.state.roles.map((res) => {
        if (res.id == id) {
          this.Select_rol = res.detalle;
        }
      });
    },
    validacion(bvModalEvt) {
      bvModalEvt.preventDefault()
      this.errors = [];
      if (
        this.username.includes("@") ||
        this.username.includes("$") ||
        this.username.includes("#") ||
        this.username.includes("&") ||
        this.username.includes("+") ||
        this.username.includes("/") ||
        this.username.includes(" ") ||
        this.username.length == 0
      ) {
        this.errors.push(
          "Please username can only contain letters and numbers "
        );
      } else {
        if (this.name.length > 3) {
          if (this.password == this.repassword) {
            if (this.password.length > 5) {
              if (this.role == 0) {
                this.errors.push("Please select the rol.");
              } else {
                const params = {
                  username: `${this.username}@${this.$store.state.companie.name}.com`,
                  name: this.name,
                  rol_id: this.role,
                  password: this.password,
                  companie_id: this.$store.state.companie.id,
                };
                  this.opened_=true;
                  this.visible_=true;
                this.$store.dispatch("PostCreateUser", params).then(() => {
                  this.$refs['my-modal'].hide();
                  this.UsuariosSubscritos().then(()=>{
                    this.$store
                    .dispatch("getUserCompanie_dash", this.$store.state.user_id)
                    .then(() => {
                        this.opened_=false;
                        this.visible_=false;
                        this.opened=false;
                        this.visible=false;
                        console.log('1',this.usuarios)
                        setTimeout(()=>{
                         
                            this.$swal(
                            "Success",
                            "User create successfully",
                            "success"
                          );
                         
                          this.cargaInicial();
                             console.log('2',this.usuarios)
                         
                        },600)
                  
                    });
                  });
                  
           
             
                });
              }
            } else {
              this.errors.push(
                "Your password should be 6 to 10 characters in length and can contain letters (A-Z, a-z), numbers (0-9) "
              );
            }
          } else {
            this.errors.push("the password no match");
          }
        } else {
          this.errors.push("the name must have more than three letters");
        }
      }
    },
    activar_user() {
      this.state.activar = false;
    },
    allLetter(inputtxt) {
      var letters = /^[A-Za-z]+$/;
      if (inputtxt.value.match(letters)) {
        return true;
      } else {
        alert("message");
        return false;
      }
    },
  },
  computed: {
    roles_dispacht() {
     // console.log('roles',this.$store.state.roles)
      return this.$store.state.roles;
    },
    acepto() {
      return this.state.activar;
    },
    usuarios() {
      return this.$store.state.user_companie;
    },
    usuariosSubscrito(){
      return this.$store.state.usuariossubscritos;
    },
  },
};
</script>
