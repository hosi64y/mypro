<template>
<div>
    <div class="form-group">
        <label>دسته بندی</label>
        <select class="form-control select2 select2-hidden-accessible" name="categories[]" style="width: 100%;"  multiple v-model="categories_selected" @change="onChange($event)" >
            <option v-for="cat in categories" :value="cat.id" >{{cat.name}}</option>
        </select>
    </div>

    <div class="form-group">
        <label >برند</label>
        <select class="form-control select2 select2-hidden-accessible" name="brand" id="brand">
            <option v-if="!product" v-for="brand in brands" :value="brand.id" >{{brand.title}}</option>
            <option v-if="product"  v-for="brand in brands" :value="brand.id" :selected="product.brand.id === brand.id">{{brand.title}}</option>
        </select>
    </div>

    <div v-if="flag">
        <div class="form-group" v-for="(attribute,index) in attributes">
            <label >ویژگی {{attribute.name}}</label>
            <select class="form-control select2 select2-hidden-accessible"  @change="change($event,index)" id="attribute">
                <option v-if="!product" v-for="attr in attribute.attributes_value" :value="attr.id">{{attr.title}}</option>
                <option v-if="product" v-for="attr in attribute.attributes_value" :selected="check(attr.id,attr.attributeGroup_id) " :value="attr.id">{{attr.title}}</option>
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
                computedSelected:[],
                once:true

            }
        },
        props:['brands','product'],
        mounted(){
            axios.get('/api/admin/categories').then(
                res=> {
                    this.getAllChildren(res.data.categories,0);
                }
            ).catch(
                err=>{console.log(err)
                }
            );
            if(this.product){
                for(var i=0;i<this.product.categories.length;i++){
                    this.categories_selected.push(this.product.categories[i].id);
                }
                this.onChange();
            }

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
            check:function(id,group_id){
                if(this.once==true){
                    for(var i=0;i<this.product.attribute_value.length;i++){
                        if(group_id == this.product.attribute_value[i].attributeGroup_id && this.product.attribute_value[i].id==id){
                                if(!this.computedSelected.includes(id)){
                                    this.computedSelected.push(id);
                                }
                                return true;
                        }
                    }
                }else {
                    for(var i=0;i<this.product.attribute_value.length;i++){
                        if(group_id == this.product.attribute_value[i].attributeGroup_id )
                            if(this.product.attribute_value[i].id==id){
                                return true;
                        }
                    }
                }
            },
            change:function(event,index){
//                if(this.attributeSelected.indexOf(event.target.value)==-1)
//                    this.attributeSelected.push(event.target.value)
                if(this.product) {
                    for (var i = 0; i < this.computedSelected.length; i++) {
                        if (i == index) {
                            this.computedSelected.splice(i, 1, parseInt(event.target.value));
                        }
                    }
                    this.once = false;
                }else {
                    this.attributeSelected.push({
                        index: index,
                        value: event.target.value
                    });
                    this.computedSelected = [];
                    for (var i = 0; i < this.attributeSelected.length; i++) {
                        this.computedSelected.push(this.attributeSelected[i].value);
                    }
                }
            }
        }

    }
</script>

<style scoped>

</style>