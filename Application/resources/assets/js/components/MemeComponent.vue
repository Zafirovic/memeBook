<template>
    <div class="row">
        <article class="article-style">
            <div>
                <a :href="single_meme_route">
                    <picture>
                        <div class="col-md-8">
                            <img
                                class="meme-img"
                                :src="this.memeimage"
                                alt="images/ImageNotFound.jpg">
                        </div>
                    </picture>
                </a>
            </div>
            <div> 
                <h4>Category: <a :href="this.show_memes_category_route"> {{this.meme.category.name}} </a></h4>
            </div>

            <meme-options
                :meme="this.meme"
                :user="this.user"
                :username="this.meme.username"
                :user_route="this.user_route"
                :delete_meme_route="this.delete_meme_route"
                :edit_meme_route="this.edit_meme_route"
            ></meme-options>
        </article>
        <br/>
    </div>
</template>

<script>
    import MemeOptions from "./MemeOptions";

    export default {

        props: {
            meme: Object,
            memeimage: String,
            user: Object,
            single_meme_route: String,
            user_route: String,
            delete_meme_route: String,
            edit_meme_route: String,
            show_memes_category_route: String
        },
    };
</script>
