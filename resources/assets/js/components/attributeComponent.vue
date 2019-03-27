<template>
<div>
    <div class="form-group">
        <label>دسته بندی</label>
        <select class="form-control select2 select2-hidden-accessible" name="category_parent" style="width: 100%;" tabindex="-1" aria-hidden="true" multiple>
            <!--@foreach($categories as $cat)-->
            <!--<option value="{{$cat->id}}">{{$cat->name}}</option>-->
            <!--@if(count($cat->childrenRecorsive)>0)-->
            <!--@include('admin.partials.category',['categories'=>$cat->childrenRecorsive,'level'=>1])-->
            <!--@endif-->
            <!--@endforeach-->
            <option v-for="cat in categories" :value="cat.id">{{cat.name}}</option>

        </select>
    </div>
    <div class="form-group">
        <label >برند</label>
        <select class="form-control select2 select2-hidden-accessible" name="brand" id="brand">
            <!--@foreach($brands as $brand)-->
            <!--<option value="{{$brand->id}}">{{$brand->title}}</option>-->
            <!--@endforeach-->
            <option v-for="brand in brands" :value="brand.id">{{brand.title}}</option>

        </select>
    </div>
</div>
</template>

<script>
    export default{
        name: "attributeComponent",
        data(){
            return {
                categories:[],
            }
        },
        props:['brands'],
        mounted(){
            axios.get('/api/admin/categories').then(
                res=> {
                    // this.categories=res.data.categories;
                    this.getAllChildren(res.data.categories,0);
                    console.log(this.categories);

                }
            ).catch(
                err=>{console.log(err)}
            );
        },methods:{
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
            }
        }

    }
</script>

<style scoped>

</style>