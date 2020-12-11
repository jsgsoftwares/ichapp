<template>
  <div
    class="tab-pane fade"
    id="pills-setting-justified"
    role="tabpanel"
    aria-labelledby="pills-setting-tab-justified"
  >
    <div class="chat-settingbar">
      <div class="chat-left-headbar">
        <div class="row align-items-center">
          <div class="col-9">
            <ul class="list-unstyled mb-0">
              <li class="media">
                <img
                  class="align-self-center mr-2"
                  src="/assets/images/logo.svg"
                  alt="Generic placeholder image"
                />
                <div class="media-body">
                  <h5 class="mb-0 mt-2">Setting</h5>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-3">
            <div class="dropdown">
              <a
                href="#"
                id="settingDropdown"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="feather icon-more-vertical-"></i>
              </a>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="settingDropdown"
              >
                <a class="dropdown-item font-14" href="#">Reset to Defaults</a>
                <a class="dropdown-item font-14" href="#">Backup</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="chat-left-body">
        <p class="setting-header">General Settings</p>
        <div class="general-setting">
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Notification Sounds</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="notificationSound"
                  checked
                />
                <label
                  class="custom-control-label"
                  for="notificationSound"
                ></label>
              </div>
            </div>
          </div>
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">New Message Alerts</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="newMessageAlerts"
                />
                <label
                  class="custom-control-label"
                  for="newMessageAlerts"
                ></label>
              </div>
            </div>
          </div>
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Show Mini Messages in Sidebar</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="showMiniMessages"
                />
                <label
                  class="custom-control-label"
                  for="showMiniMessages"
                ></label>
              </div>
            </div>
          </div>
        </div>
        <p class="setting-header">Privacy Settings</p>
        <div class="privacy-setting">
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Read Receipts</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-switch">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="readReceipts"
                  checked
                />
                <label class="custom-control-label" for="readReceipts"></label>
              </div>
            </div>
          </div>
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Show Profile Picture</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-switch">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="showProfilePicture"
                />
                <label
                  class="custom-control-label"
                  for="showProfilePicture"
                ></label>
              </div>
            </div>
          </div>
          <div class="row align-items-center pb-3">
            <div class="col-9">
              <h6 class="mb-0">Allow Messages from Strangers</h6>
            </div>
            <div class="col-3 text-right">
              <div class="custom-control custom-switch">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="allowMessageToStrangers"
                />
                <label
                  class="custom-control-label"
                  for="allowMessageToStrangers"
                ></label>
              </div>
            </div>
          </div>
        </div>
        <p class="setting-header">Design Settings</p>
        <div class="design-setting custom-checkbox-button">
          <div class="form-check-inline checkbox-primary">
            <input
              type="checkbox"
              id="customCheckboxInline5"
              name="customCheckboxInline2"
              checked
            />
            <label for="customCheckboxInline5"></label>
          </div>
          <div class="form-check-inline checkbox-secondary">
            <input
              type="checkbox"
              id="customCheckboxInline6"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline6"></label>
          </div>
          <div class="form-check-inline checkbox-success">
            <input
              type="checkbox"
              id="customCheckboxInline7"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline7"></label>
          </div>
          <div class="form-check-inline checkbox-danger">
            <input
              type="checkbox"
              id="customCheckboxInline8"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline8"></label>
          </div>
          <div class="form-check-inline checkbox-warning">
            <input
              type="checkbox"
              id="customCheckboxInline9"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline9"></label>
          </div>
          <div class="form-check-inline checkbox-info">
            <input
              type="checkbox"
              id="customCheckboxInline10"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline10"></label>
          </div>
          <div class="form-check-inline checkbox-light">
            <input
              type="checkbox"
              id="customCheckboxInline11"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline11"></label>
          </div>
          <div class="form-check-inline checkbox-dark">
            <input
              type="checkbox"
              id="customCheckboxInline12"
              name="customCheckboxInline2"
            />
            <label for="customCheckboxInline12"></label>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
