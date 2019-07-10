<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follow'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return {
                status: this.follow,
            }
        },
        methods: {
            followUser(){
                axios.post('../follow/' + this.userId)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = 'http://localhost/laravel/codergram/public/login';
                        }
                    })
            }
        },
        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
