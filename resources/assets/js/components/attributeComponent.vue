<template>
<div>

    <div class="form-group">
        <label>دسته بندی</label>
        <select class="form-control select2 select2-hidden-accessible" name="categories[]" style="width: 100%;"  multiple v-model="categories_selected" @change="onChange($event)" >
            <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>
        </select>
    </div>

    <div class="form-group">
        <label >برند</label>
        <select class="form-control select2 select2-hidden-accessible" name="brand" id="brand">
            <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>
        </select>
    </div>

    <div v-if="flag">
        <div class="form-group" v-for="(attribute,index) in attributes">
            <label >ویژگی {{attribute.name}}</label>
            <select class="form-control select2 select2-hidden-accessible"  @change="change($event,index)" id="attribute">
                <option v-for="attr in attribute.attributes_value" :value="attr.id">{{attr.title}}</option>
            </select>
        </div>
    </div>

    <input type="hidden" name="attributes[]" :value="computedSelected">

</div>
</template>

<script>
    export default{
        name: "attributeComponent",
        data(){
            return {
                categories:[],
                categories_selected:[],
                flag:false,
                attributes:[],
                attributeSelected:[],
                computedSelected:[]

            }
        },
        props:['brands'],
        mounted(){
            axios.get('/api/admin/categories').then(
                res=> {
                    this.getAllChildren(res.data.categories,0);
                }
            ).catch(
                err=>{console.log(err)}
            );
        },methods:{
            onChange:function(event){
                this.flag=true;
//                axios.get('/api/admin/attribute/'+JSON.stringify(categories)).then(res=>{
                axios.post('/api/admin/attribute',this.categories_selected).then(res=>{
                    this.flag=true;
                    this.attributes=res.data.attributes;

                }).catch(err=> {
                    console.log(err);
                })
            },
            getAllChildren:function(currentValue,level) {
                for (var i=0;i<currentValue.length;i++){
                    var current=currentValue[i];
                    this.categories.push({
                        id:current.id,
                        name:Array(level+1).join("-----")+" "+current.name
                    });
                    if (current.children_recorsive && current.children_recorsive.length>0){
                        this.getAllChildren(current.children_recorsive,level+1)
                    }
                } 
            },
            change:function(event,index){
                console.log(event.target.value,index);
//                if(this.attributeSelected.indexOf(event.target.value)==-1)
//                    this.attributeSelected.push(event.target.value)
                for (var i=0;i<this.attributeSelected.length;i++){
                  var current=this.attributeSelected[i];
                  if(current.index==index)
                      this.attributeSelected.splice(i,1);
                }
                this.attributeSelected.push({
                    index:index,
                    value:event.target.value
                });
                this.computedSelected=[];
                for (var i=0;i<this.attributeSelected.length;i++) {
                    this.computedSelected.push(this.attributeSelected[i].value);
                }
            }
        }

    }
</script>

<style scoped>

</style>