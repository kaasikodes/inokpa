<template>
    <div>
        
        <p>@{{example}}</p>
        
    </div>
</template>

<script>
export default {
        data(){
            return {
                articles:[
                    {title:'red',
                    body:'green',
                    id:1
                    },
                    {title:'red',
                    body:'green',
                    id:2
                    }
                ],
                article_single:{
                    id: '',
                    title:'',
                    body:''

                },
                id:'',
                pagination:{},
                edit:false,
                example: 'works'
            }

        },
        mounted: function(){
            this.fetchArticles();
        },
        methods: {
            fetchArticles: function(){
                fetch('/api/articles')
                .then(res => res.json())
                .then(res =>{
                    this.articles = res.data
                    this.example = 'real niggas'
                    console.log(this.articles)
                   
                    

                }).bind(this);
            },

            greet: function (name) {
                return 'Greetings, great'+' '+ name
                
            }

        }
        
    
}
</script>