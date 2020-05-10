<template>
  <div class="col-8 offset-2">

    <div class="card">
         <div class="card-header"><h3> <i class="fa fa-smile-beam text-success"></i> Contactame </h3></div>
      <div class="card-body">
     

    
    <form @submit.prevent="onSubmit" class="contact">

      <BaseInput label="Nombre" 
       v-model="$v.form.name.$model"
       :validator="$v.form.name"
       ></BaseInput>
  <pre>
      {{ $v }}
  </pre>
      <BaseInput label="Apellido" 
       v-model="$v.form.surname.$model"
              :validator="$v.form.surname"
       ></BaseInput>
      <BaseInput 
      label="Email" 
      type="email" 
      v-model="$v.form.email.$model"
      :validator="$v.form.email"
      ></BaseInput>
      <BaseInput 
      label="Telefono"
      :mask="'(###) ###-####'"
       v-model="$v.form.phone.$model"
       :validator="$v.form.phone"
       ></BaseInput>

    <div class="form-group">
      <label>Contenido</label>
      <textarea 
      v-model="$v.form.content.$model" 
      class="form-control"
           :class="{
           'is-valid':!validator.$error && validator.$dirty,
           'is-invalid':$v.form.validator.$error,
       }"
       rows="3"></textarea>
    </div>
    <button 
    :disabled="!formValid"
    
    type="submit" class="btn btn-primary"> <i class="fa fa-envelope"></i> Enviar</button>

    <button class="btn btn-danger btn-sm" @click="resetForm"><i class="fa fa-redo"></i> Limpiar</button>

    </form>
    </div>
    </div>
  </div>
</template>

<script>
import BaseInput from "../components/BaseInput.vue"
import {required, minLength, email} from 'vuelidate/lib/validators'
export default {
  components:{BaseInput},
  data(){
    return{
      form:{
        name:"alex",
        surname:"",
        email:"",
        phone:"",
        content:""
      }
    }
  },
  validations:{
    form:{
      name:{
        required,
        minLength:minLength(2)
      },
       surname:{
        required,
        minLength:minLength(2)
      },
       email:{
        required,
        email
      },
        phone:{
        required,
        minLength:minLength(14)
      },
      content:{
        required
      }
    }
  },
  methods:{

    resetForm(){

      this.$v.form.name.$model = ""
      this.$v.form.surname.$model = ""
      this.$v.form.email.$model = ""
      this.$v.form.phone.$model = ""
      this.$v.form.content.$model = ""

      this.$v.$reset()

      document.querySelectorAll("form.contact input.contact textares").forEach(e => e.value="")
        this.$awn.info("Formulario reinicado")

    },

    onSubmit(){

      if(!this.formValid)
        return 

        axios.post('/api/contact',{
          name:this.$v.form.name.$model,
          surname:this.$v.form.surname.$model,
          email: this.$v.form.email.$model,
          message: this.$v.form.message.$model,
          phone: this.$v.form.phone.$model,
       
       }).then(function(response){
          console.log(response.data);
              this.$awn.success("Contacto guardado con exito")

       })

    }
  },
  computed:{
    formValid(){

      return !this.$v.$invalid;

      /*return this.form.name.length > 0 &&
        this.form.surname.length > 0 &&
        this.form.phone.length > 0 &&
        this.form.email.length > 0 &&
        this.form.content.length > 0 
*/

    }
  }
  
};
</script>
<style lang="scss">
  @import '~vue-awesome-notifications/dist/styles/style.scss';

</style>