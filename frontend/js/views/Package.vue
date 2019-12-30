<template>
    <div>
        <div class="mb-5 flex justify-between">
            <div @click="$router.go(-1)" class="flex cursor-pointer ">
                <img class="mr-2" src="https://img.icons8.com/android/24/000000/back.png"><span>Back</span>
            </div>
            <router-link to="/">
                Home
            </router-link>
        </div>

        <div class="pt-8" v-if="p">
            <div class="flex items-center justify-between">
                <h1 class="font-semibold text-3xl mb-3">
                    {{ p.name }}
                </h1>
                <div class="text-sm">
                    <a :href="'mailto:'+p.maintainer.email">{{ p.maintainer.name}} <span class="text-gray-700">({{ p.maintainer.email}})</span></a>
                </div>
            </div>

            <pre v-html="p.description" class="pl-0 p-5 text-sm">
            </pre>

            <div>
                <div class="flex">
                    <div class="w-1/2" v-if="p.depends">
                        <h3 class="font-semibold mb-3">Dependencies</h3>
                        <ul>
                            <li v-for="d in p.depends" class="py-1">
                                <router-link :to="{name: 'package', params: {p: d}}"> {{ d }}</router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="w-1/2" v-if="p.reverse_depends">
                        <h3 class="font-semibold mb-3">Reverse Dependencies</h3>
                        <ul>
                            <li v-for="d in p.reverse_depends" class="py-1">
                                <router-link :to="{name: 'package', params: {p: d}}"> {{ d }}</router-link>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

const api = '/api/package/';

export default {
    data() {
        return {
            p: null,
        };
    },
    mounted() { this.fetchPackage() },

    methods: {
        fetchPackage() {
            axios.get(api + this.$route.params.p)
                .then(response => {
                    this.p = response.data;
                });
        }
    },

    watch: {
        '$route'() {
            this.fetchPackage();
        }
    }
}
</script>