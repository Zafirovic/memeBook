<template>
    <div :v-if="!isFetching">
        <div class="profile">
            <div class="row">
                <div>
                    <div id="basic-info row">
                        <h1>
                            Username: <i>{{ this.user.name }}</i>
                            <avatar class="avatar-photo"
                                    :username="this.user.name"
                                    :src="this.user.avatar"
                                    :size=75
                                    :inline="true">
                            </avatar>
                        </h1>
                    </div>
                    <td>
                        <div>
                            <i><h4> {{ this.memesCount }} memes
                                <a :href="this.show_user_followers">{{ this.user.followers }} Followers </a>
                                <a :href="this.show_user_following">{{
                                    this.user.following }} Following</a>
                            </h4></i>
                        </div>
                        <follow-component :user="user"
                                          :auth_user="auth_user"
                                          :follow_route="follow_route"
                                          :unfollow_route="unfollow_route">
                        </follow-component>
                    </td>
                    <br>
                    <div v-if="this.auth_user !== null && this.user.id == this.auth_user.id">
                        <a :href="this.edit_username_route">Edit Username</a>
                        <br>
                        <a :href="this.edit_password_route">Edit Password</a>
                        <br>
                        <br>
                        <a :href="this.delete_account_route"><i><u>Delete you account?</u></i></a>
                    </div>
                    <div>
                        <div v-if="this.memes.data.length > 0">
                            <div v-for="meme in this.memes.data">
                                <meme-component :meme="meme"
                                                :user="auth_user"
                                                :memeimage="meme.sourceImage"
                                                :single_meme_route="'/meme/single/' + meme.id"
                                                :user_route="'/users/' + meme.user_id"
                                                delete_meme_route="'/meme/delete'">
                                </meme-component>
                            </div>
                        </div>
                        <div v-else>
                            <div class="no-memes-text">
                                <h3>There are currently no uploaded memes.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MemeComponent from "./MemeComponent";
    import Avatar from 'vue-avatar';
    import FollowComponent from "./FollowComponent";

    export default {
        components: {
            Avatar
        },
        props: {
            memes: {
                Default: null,
            },
            user: Object,
            auth_user: Object,
            follow_route: String,
            unfollow_route: String,
            images_source: String,
            edit_username_route: String,
            edit_password_route: String,
            show_user_followers: String,
            show_user_following: String,
            delete_account_route: String
        },
        computed: {
            memesCount: function () {
                return this.memes.data.length > 0 ? this.memes.data.length : 0
            }
        },
        data() {
            return {
                // isFollowing: false,
                isFetching: true,
                csrfToken: $('meta[name="csrf-token"]').attr("content"),
            }
        },
        mounted() {
            // this.IsFollowingCheck();
            this.isFetching = false;
        },
        methods: {
            // async IsFollowingCheck() {
            //     await $.ajax({
            //         url: "/user/follows",
            //         type: "POST",
            //         data: {user_id: this.user.id},
            //         headers: {
            //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            //         },
            //         error: function (xhr, error) {
            //             if (xhr.status == 401) window.location.href = "/login";
            //             else if (xhr.status == 404) window.history.back();
            //             else if (xhr.status == 500) console.log(xhr);
            //             else console.log(error);
            //         },
            //     }).done(following => this.isFollowing = JSON.parse(following.data));
            // },
            DisableFollow() {

            }
        },
    };
</script>

