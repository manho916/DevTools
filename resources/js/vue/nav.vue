<template>
    <div class="nav">
        <a href="/vc"><div class="nav-li">VideoCategories</div></a>
        <a href="/search"><div class="nav-li">Search</div></a>
        <a href="/videos"><div class="nav-li">Video</div></a>
        <a href="/channels"><div class="nav-li">Channels</div></a>
        <a href="/vc"><div class="nav-li">Subscriptions</div></a>
    </div>
</template>

<script>
export default{

}

</script>

<style scoped>
    .nav{
        display: flex;
        flex-direction: column;
        position:fixed;
        top: 0;
        left: 0;
        width:200px;
        min-height: 100%;
        background-color: #1C3144;
    }
    .nav-li{
        padding: 10px;
        color: #C3D898;
    }
    .nav-li:hover{
        background-color: #C3D898;
        color: #1C3144;
        cursor: pointer;
    }


</style>
