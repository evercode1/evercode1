<template>
    
    <div>
        <form id="search">

            Search

            <input name="query"
                   v-model="$parent.query"
                   @keyup="$parent.search($parent.query)"
                   class="search-box margin-10">
        </form>



    </div>

</template>