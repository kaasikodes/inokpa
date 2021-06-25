<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{example}}
                        <button @click="clickme()">Get all data</button>
                            <p>{{counter}}</p>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        data: function(){
            return{
                example: 'readyerere',
                articles: [],
                counter: 21
            }
        },
        methods: {
            clickme(){
                this.counter += 1
                console.log(this.counter)

            }
        }
    }
</script>
