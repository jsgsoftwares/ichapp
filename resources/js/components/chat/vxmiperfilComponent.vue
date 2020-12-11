<template>
  <div
    class="tab-pane fade"
    id="pills-profile-justified"
    role="tabpanel"
    aria-labelledby="pills-profile-tab-justified"
  >
    <div class="chat-profilebar">
      <div class="chat-left-headbar">
        <div class="row align-items-center">
          <div class="col-12">
            <ul class="list-unstyled mb-0">
              <li class="media">
                <img
                  class="align-self-center mr-2"
                  src="/assets/images/logo.svg"
                  alt="Generic placeholder image"
                />
                <div class="media-body">
                  <h5 class="mb-0 mt-2">My Profile</h5>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="chat-left-body">
        <div class="profilebar">
          <img
            class="profile-pic img-fluid"
            src="/assetsassets/images/men.svg"
            alt="profile-pic"
          />
          <div class="profile-edit">
            <i class="feather icon-camera upload-button"></i>
            <input class="profile-upload" type="file" accept="image/*" />
          </div>
          <h5>Will Patinson</h5>
          <p class="mb-0">Florida, USA</p>
        </div>
        <div class="profile-detail">
          <ul class="list-unstyled mb-0">
            <li class="media">
              <i class="feather icon-user align-self-center"></i>
              <div class="media-body">
                <p>Username</p>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    value="Will Patinson"
                    aria-label="Will Patinson"
                    aria-describedby="button-addon-group-username"
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-link"
                      type="button"
                      id="button-addon-group-username"
                    >
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <i class="feather icon-map align-self-center"></i>
              <div class="media-body">
                <p>Location</p>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    value="Florida, USA"
                    aria-label="Florida, USA"
                    aria-describedby="button-addon-group-location"
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-link"
                      type="button"
                      id="button-addon-group-location"
                    >
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <i class="feather icon-message-square align-self-center"></i>
              <div class="media-body">
                <p>Status</p>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    value="I am on Gappa."
                    aria-label="I am on Gappa"
                    aria-describedby="button-addon-group-status"
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-link"
                      type="button"
                      id="button-addon-group-status"
                    >
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <i class="feather icon-mail align-self-center"></i>
              <div class="media-body">
                <p>Email ID</p>
                <div class="input-group">
                  <input
                    type="email"
                    class="form-control"
                    value="demo@example.com"
                    aria-label="demo@example.com"
                    aria-describedby="button-addon-group-emailid"
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-link"
                      type="button"
                      id="button-addon-group-emailid"
                    >
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </li>
            <li class="media">
              <i class="feather icon-lock align-self-center"></i>
              <div class="media-body">
                <p>Password</p>
                <div class="input-group">
                  <input
                    type="password"
                    class="form-control"
                    value="********"
                    aria-label="********"
                    aria-describedby="button-addon-group-password"
                    autocomplete="off"
                    style='background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC"); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;'
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-link"
                      type="button"
                      id="button-addon-group-password"
                    >
                      Update
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
