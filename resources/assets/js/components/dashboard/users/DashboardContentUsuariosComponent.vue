<template>
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
          <br />
          <div class="row breadcrumbs-top">
            <div class="col-12">
              <h2 class="content-header-title float-left mb-0">Users</h2>
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#exampleModal"
                data-whatever="@mdo"
              >
                <i class="feather icon-plus-circle"></i>
                Add new
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
        <!-- Data list view starts -->
        <section id="data-list-view" class="data-list-view-header">
          <!-- DataTable starts -->
          <div class="table-responsive">
            <table class="table data-list-view">
              <thead>
                <tr>
                  <th>STATE</th>
                  <th>NAME</th>
                  <th>USUARIO</th>
                  <th>ROL</th>
                  <th>ACTION</th>
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

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document" ref="modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New user</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="badge badge-warning">
              Important note: each added user has an additional cost
            </span>
            <p><span class="badge badge-warning">If you add a user and want to delete it after the first 5 days of the month, you must wait until the next invoice closing.</span></p>
            <div class="custom-control custom-checkbox">
              <b-form-checkbox
                align="right"
                v-model="checked"
                @change="activar_user()"
                name="check-button"
                checkbox
                >I understand, I want to do it
              </b-form-checkbox>
            </div>
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
                  v-model="name"
                  :disabled="acepto"
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
                  :disabled="acepto"
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
                  :disabled="acepto"
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
                <label for="message-text" class="col-form-label">Rol:</label>
                <div class="dropdown">
                  <button
                    :disabled="acepto"
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
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button
              type="button"
              :disabled="acepto"
              @click="validacion()"
              class="btn btn-primary"
            >
              Create
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END: Content-->
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
      username: "",
      name: "",
      password: "",
      repassword: "",
      Select_rol: "Select rol",
      role: 0,
      state: {
        activar: true,
      },
    };
  },
  mounted() {
    this.$store
      .dispatch("getUserCompanie_dash", this.$store.state.user_id)
      .then(() => {
        this.$store.dispatch("getRols_dash");
        //console.log(this.$store.state.roles);
        this.companieName = `@${this.$store.state.companie.name}.com`;
      });
  },
  methods: {
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
      this.role = id;
      this.$store.state.roles.map((res) => {
        if (res.id == id) {
          this.Select_rol = res.detalle;
        }
      });
    },
    validacion() {
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
                this.$store.dispatch("PostCreateUser", params).then(() => {
                  $("#exampleModal").modal("hide");
                  this.$store
                    .dispatch("getUserCompanie_dash", this.$store.state.user_id)
                    .then(() => {
                      this.$swal(
                        "Success",
                        "User create successfully",
                        "success"
                      );
                      this.$store.dispatch("setpaginas", "usuarios");
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
      this.state.activar = this.checked;
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
      return this.$store.state.roles;
    },
    acepto() {
      return this.state.activar;
    },
    usuarios() {
      return this.$store.state.user_companie;
    },
  },
};
</script>
