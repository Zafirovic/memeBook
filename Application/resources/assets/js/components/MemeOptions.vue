<template>
  <div class="control-panel container">
    <div class="row">
      <div class="profile-options">
        <h5 style="color: #666">
          Likes:
          <span :id="'votes-' + this.meme.id"> {{ this.meme.numOfVotes }} </span>
        </h5>
        <div class="row" style="color: whitesmoke">
          <h3>
            <a class="btn vote"
              :style="'background-color:' + this.meme.voted['upvoted']"
              :id="'meme_upvote-' + this.meme.id"
              @click="upvote()"
              href="#!"
              role="button">
              <i class="fas fa-arrow-circle-up fa-xs" style="font-size: 2.5em"></i>
            </a>
          </h3>
          <h3>
            <a class="btn vote"
              :style="'background-color:' + this.meme.voted['downvoted']"
              :id="'meme_downvote-' + this.meme.id"
              @click="downvote()"
              href="#!"
              role="button">
              <i class="fas fa-arrow-circle-down fa-xs" style="font-size: 2.5em"></i>
            </a>
          </h3>
        </div>
      </div>
      <div class="user-options row-fluid">
        <div class="profile-view">
          <b><h5>User profile:</h5> </b>
          <a :href="this.user_route">
            <span><h4>{{ this.username }}</h4></span>
          </a>
        </div>
        <div class="meme-options">
          <a
            v-if="this.user !== null"
            id="delete_meme_button"
            class="btn"
            :href="this.edit_meme_route"
            >Edit Meme
          </a>
          <a style="display:inline-block;">
            <form :action="this.delete_meme_route" method="post" name="delete-meme-form">
              <input type="hidden" name="_token" v-bind:value="csrfToken">
              <input type="hidden" id="meme_id" name="meme_id" :value="this.meme.id">
              <button
                v-if="this.user !== null && this.user.id == this.meme.user_id"
                class="btn btn-danger"
                type="submit"
              >
                Delete Meme
              </button>
            </form>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    meme: Object,
    username: String,
    user: Object,
    user_route: String,
    delete_meme_route: String,
    edit_meme_route: String
  },
  data() {
    return {
      csrfToken: $('meta[name="csrf-token"]').attr("content"),
    }
  },
  methods: {
    upvote() {
      $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: "/meme/vote",
          data: { meme_id: this.meme.id, vote: 1 },
          type: "POST",
        success: function (data) {
          var upvoteButton = $("#meme_upvote-" + data.meme_id);
          var downvoteButton = $("#meme_downvote-" + data.meme_id);
          switch (data.type) {
            case "created":
              upvoteButton.css("background-color", "#99CCFF");
              break;
            case "updated":
              upvoteButton.css("background-color", " #99CCFF");
              downvoteButton.css("background-color", "#f0f0f0");
              break;
            case "deleted":
              upvoteButton.css("background-color", "#f0f0f0");
              break;
          }
          $("#votes-" + data.meme_id).html(data.sum);
        },
        error: function (xhr) {
          if ((xhr.status == 401)) window.location.href = "/login";
          else if ((xhr.status == 400)) return; //[TODO]:show toast message
        },
      });
    },
    downvote() {
      $.ajax({
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          url: "/meme/vote",
          data: { meme_id: this.meme.id, vote: -1 },
          type: "POST",
        success: function (data) {
          var upvoteButton = $("#meme_upvote-" + data.meme_id);
          var downvoteButton = $("#meme_downvote-" + data.meme_id);
          switch (data.type) {
            case "created": {
              downvoteButton.css("background-color", "#99CCFF");
              break;
            }
            case "updated": {
              upvoteButton.css("background-color", "#f0f0f0");
              downvoteButton.css("background-color", " #99CCFF");
              break;
            }
            case "deleted": {
              downvoteButton.css("background-color", "#f0f0f0");
              break;
            }
          }
          $("#votes-" + data.meme_id).html(data.sum);
        },
        error: function (xhr) {
          if ((xhr.status == 401)) window.location.href = "/login";
          else if ((xhr.status == 400)) return; //[TODO]:show toast message
        },
      });
    },
  }
};
</script>
