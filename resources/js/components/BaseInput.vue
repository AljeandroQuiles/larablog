<template>
     <div class="form-group">
      <label>{{ label }}}</label>
      <input v-if="mask"
      v-mask="mask"
       v-on:input="$emit('input',$event.target.value)"
       :type="type" 
       :class="{
           'is-valid':!validator.$error && validator.$dirty,
           'is-invalid':validator.$error,
       }"
       class="form-control">

        <input v-else
       v-on:input="$emit('input',$event.target.value)"
       :type="type" 
            :class="{
           'is-valid':!validator.$error && validator.$dirty,
           'is-invalid':validator.$error,
       }"
       class="form-control">
    </div>
</template>

<script>




export default {
    props:{
        label:{
            type:String,
            required:true
        },
        type:{
             type:String,
             dafault:'text',
             validator(value){
                 return['text','email','password'].includes(value);
             }
        },
        value:{
              type:String,
              required:true
        },
        validator:{
            type:Object,
            required:true
        },
        mask:{
             type:String,
              required:false
        }
    }
}
</script>