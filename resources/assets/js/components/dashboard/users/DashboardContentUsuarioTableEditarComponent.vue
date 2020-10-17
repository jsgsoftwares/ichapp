<template>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <br />
          <div class="row breadcrumbs-top">
            <div class="col-12">
                   <button
                    class="btn btn-info"
                    @click="cerrar()"
                    >
                      <i class="feather icon-skip-back"></i>
                      Back
                    </button>
           
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
          <div class="header">
            <h5 class="title" id="exampleModalLabel">Edit user</h5>

          </div>
          <div class="modal-body">
  
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label"
                  >Username:</label
                >
                <div class="input-group mb-3">
                  <input
                    :disabled="acepto"
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
                  v-model="nameuser"
                  
                  class="form-control"
                  id="recipient-name"
                />
              </div>

              <div class="form-group">
            <br/>
                <b-input-group  prepend="New password:" class="mb-2">
                    <b-form-input type="password" :disabled="habili"  @blur="validarPass()" v-model="password"></b-form-input>
                    <b-input-group-append is-text>
                    <b-form-checkbox switch @change="newpass()" 
                     v-model="checked"
                     class="mr-n2 mb-n1" >
                        Change

                    </b-form-checkbox>
                    </b-input-group-append>
                </b-input-group>
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
                 <!-- Using components -->
                <b-input-group prepend="Repeat password" class="mt-3">
                    <input
                    type="password"
                    :disabled="habili"
                    v-model="repassword"
                    class="form-control"
                    id="recipient-name"
                    @blur="validarPassMatch()"
                    
                    /> 
                 </b-input-group>
                <p v-if="passErrRe.length" variant="danger">
          
                    <ul>
                      <li style="color:red" v-for="error in passErrRe" >{{ error }}</li>
                    </ul>
                 </p>
              </div>

              <div class="form-group col">
                <label for="message-text" class="col-form-label">Rol:</label>
                <div class="dropdown">
                  <button
                    :disabled="creadorRol"
                    size="sm"
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    {{rol_select}}
                  </button>
                  <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a
                      class="dropdown-item"
                      href="#"
                      v-for="rol in roles"
                      :key="rol.id"
                      @click="rolselect(rol.id)"
                      >{{ rol.detalle }}</a
                    >
                  </div>
                </div>
                  <p v-if="errors.length" variant="danger">
                    <b>Please correct the following error (s):</b>
                    <ul>
                      <li style="color:red" v-for="error in errors" >{{ error }}</li>
                    </ul>
                 </p>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
            @click="cerrar()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              @click="validacion()"
              class="btn btn-primary"
            >
              Update
            </button>
          </div>
      </div>
    </div>


  </div>
</template>
<script>
export default {
  data() {
    return {
      errors: [],
      passErr: [],
      passErrRe: [],
      checked: false,
      companieName: "",
      nameuser: "",
      rol_select: "Select rol",
      password: "nochange",
      repassword: "nochange",
      creador: 0,
      role: 0,
      state: {
        activar: true,
        activado: true,
      },
    };
  },
  mounted() {
    this.nameuser = this.usuario.name;
    this.rol_select = this.usuario.rol;
    this.role = this.usuario.rol_id;
    this.creador = this.usuario.creator;
  },

  methods: {
    newpass() {
      this.state.activar = this.checked;
    },
    rolselect(id) {
      this.role = id;

      this.$store.state.roles.map((res) => {
        if (res.id == id) {
          this.rol_select = res.detalle;
        }
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
    validacion() {
      this.errors = [];

      if (this.nameuser.length > 3) {
        if (this.password == this.repassword) {
          if (this.password.length > 5) {
            if (this.role == 0) {
              this.errors.push("Please select the rol.");
            } else {
              const params = {
                id: this.usuario.id,
                name: this.nameuser,
                rol_id: this.role,
                password: this.password,
                companie_id: this.$store.state.companie.id,
              };
              this.$store.dispatch("PostUpdateUser", params).then(() => {
                this.$store.dispatch("setpaginas", "usuarios");
                this.$store
                  .dispatch("getUserCompanie_dash", this.$store.state.user_id)

                  .then(() => {
                    (this.nameuser = ""),
                      this.$swal(
                        "Success",
                        "User update successfully",
                        "success"
                      );
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
    },
    cerrar() {
      this.$store
        .dispatch("getUserCompanie_dash", this.$store.state.user_id)

        .then(() => {
          this.$store.dispatch("setpaginas", "usuarios");
        });
    },
  },

  computed: {
    roles() {
      return this.$store.state.roles;
    },
    acepto() {
      return this.state.activado;
    },
    username() {
      return this.usuario.email;
    },

    usuario() {
      return this.$store.state.userxid;
    },
    habili() {
      return this.state.activar;
    },
    creadorRol() {
      if (this.$store.state.userxid.creator == 1) {
        return true;
      }
      return false;
    },
  },
};
</script>