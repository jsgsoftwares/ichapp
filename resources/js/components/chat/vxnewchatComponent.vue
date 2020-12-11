<template>
  <div
    class="tab-pane fade"
    id="pills-addchat-justified"
    role="tabpanel"
    aria-labelledby="pills-addchat-tab-justified"
  >
    <div class="chat-addbar">
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
                  <h5 class="mb-0 mt-2">New Chat</h5>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-3">
            <a href="#" data-toggle="modal" data-target="#createGroup">
              <i class="feather icon-users"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="chat-left-search">
        <form>
          <div class="input-group">
            <input
              type="search"
              class="form-control"
              placeholder="Search"
              aria-label="Search"
              aria-describedby="chat-left-search-user-btn"
            />
            <div class="input-group-append">
              <button class="btn" type="submit" id="chat-left-search-user-btn">
                <i class="feather icon-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="chat-left-body">
        <div
          class="nav flex-column nav-pills chat-userlist"
          id="new-chat-tab"
          role="tablist"
          aria-orientation="vertical"
        >
          <a
            class="nav-link active"
            id="new-chat-first-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="true"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/men.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>John Doe</h5>
                <p>Hey there. I am on Chalty.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-second-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/women.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Ema Star</h5>
                <p>Work mode ON !!</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-third-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/boy.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Roger Day</h5>
                <p>Let's go hiking.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-fourth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/men.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Paul Taylor</h5>
                <p>Why so serious ?</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-fifth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/girl.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Cary Peck</h5>
                <p>** No Status **</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-sixth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/women.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Meghan Murphy</h5>
                <p>Feeling happy...</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-seventh-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/boy.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Sansa Smith</h5>
                <p>World is Selfish.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-eighth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/girl.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Jelly Witherspoon</h5>
                <p>Best day of my life.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-ninth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/men.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Loy Diesel</h5>
                <p>Hoping for better tomorrow.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-tenth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/boy.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Sham Chaterjee</h5>
                <p>No Status</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-eleventh-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/girl.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Krishna Nayar</h5>
                <p>Looking for Graphics Designer.</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-twelth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/men.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Arjun Lohia</h5>
                <p>Mood Off</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-thirteenth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/boy.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Mike Spencer</h5>
                <p>It's School time</p>
              </div>
            </div>
          </a>
          <a
            class="nav-link"
            id="new-chat-fourthinth-tab"
            data-toggle="pill"
            href="#"
            role="tab"
            aria-selected="false"
          >
            <div class="media">
              <img
                class="align-self-center rounded-circle"
                src="/assets/images/men.svg"
                alt="User Image"
              />
              <div class="media-body">
                <h5>Tom Cruz</h5>
                <p>New Job. New Asporations.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
