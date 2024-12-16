<template>
  <div class="row">
    <div class="col-lg-10 m-auto">

      <!-- <v-card class="mb-5">
        <v-tabs
          v-model="tab"
          align-tabs="center"
          color="deep-purple-accent-4"
        >
          <v-tab :value="1">Your recipes</v-tab>
          <v-tab :value="2">Explore</v-tab>
        </v-tabs>

        <v-tabs-window v-model="tab">
          <v-tabs-window-item
            v-for="n in 3"
            :key="n"
            :value="n"
          >
            <v-container fluid>
              <v-row>
                <v-col
                  v-for="i in 6"
                  :key="i"
                  cols="12"
                  md="4"
                >
                  <v-img
                    :lazy-src="`https://picsum.photos/10/6?image=${i * n * 5 + 10}`"
                    :src="`https://picsum.photos/500/300?image=${i * n * 5 + 10}`"
                    height="205"
                    cover
                  ></v-img>
                </v-col>
              </v-row>
            </v-container>
          </v-tabs-window-item>
        </v-tabs-window>
      </v-card> -->

    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue'

  const items = ref(Array.from({ length: 30 }, (k, v) => v + 1))
  const tab = ref(null);

  async function api () {
    return new Promise(resolve => {
      setTimeout(() => {
        resolve(Array.from({ length: 10 }, (k, v) => v + items.value.at(-1) + 1))
      }, 1000)
    })
  }
  async function load ({ done }) {
    // Perform API call
    const res = await api()

    items.value.push(...res)

    done('ok')
  }
</script>
