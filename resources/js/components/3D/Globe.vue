<script setup>

import { ref, onMounted } from 'vue'

import * as THREE from 'three'

import { OrbitControls }
from 'three/examples/jsm/controls/OrbitControls.js'

const container = ref(null)

const destinations = [

    {
        nom: 'Madagascar',
        latitude: -18.7669,
        longitude: 46.8691
    },

    {
        nom: 'Paris',
        latitude: 48.8566,
        longitude: 2.3522
    },

    {
        nom: 'Tokyo',
        latitude: 35.6764,
        longitude: 139.6500
    },

    {
        nom: 'New York',
        latitude: 40.7128,
        longitude: -74.0060
    },

    {
        nom: 'Sydney',
        latitude: -33.8688,
        longitude: 151.2093
    }

]

onMounted(() => {

    const scene =
        new THREE.Scene()

    const camera =
        new THREE.PerspectiveCamera(
            45,
            container.value.clientWidth /
            container.value.clientHeight,
            0.1,
            1000
        )

    camera.position.z = 20

    const renderer =
        new THREE.WebGLRenderer({
            antialias: true,
            alpha: true
        })

    renderer.setSize(
        container.value.clientWidth,
        container.value.clientHeight
    )

    renderer.setPixelRatio(
        window.devicePixelRatio
    )

    container.value.appendChild(
        renderer.domElement
    )

    // Lumières

    const ambient =
        new THREE.AmbientLight(
            0xffffff,
            1.5
        )

    scene.add(ambient)

    const sun =
        new THREE.DirectionalLight(
            0xffffff,
            2
        )

    sun.position.set(
        5,
        3,
        5
    )

    scene.add(sun)

    // Terre

    const texture =
        new THREE.TextureLoader().load(
            '/textures/earth.jpg'
        )

    const earth =
        new THREE.Mesh(

            new THREE.SphereGeometry(
                5,
                64,
                64
            ),

            new THREE.MeshStandardMaterial({
                map: texture
            })

        )

    scene.add(earth)

    // Atmosphère

    const atmosphere =
        new THREE.Mesh(

            new THREE.SphereGeometry(
                5.15,
                64,
                64
            ),

            new THREE.MeshBasicMaterial({
                color: 0x4da6ff,
                transparent: true,
                opacity: 0.35
            })

        )

    scene.add(atmosphere)

    // Fonction création marqueur

    function createMarker(
        latitude,
        longitude
    ) {

        const radius = 5.05

        const phi =
            (90 - latitude) *
            (Math.PI / 180)

        const theta =
            (longitude + 180) *
            (Math.PI / 180)

        const x =
            -(
                radius *
                Math.sin(phi) *
                Math.cos(theta)
            )

        const z =
            radius *
            Math.sin(phi) *
            Math.sin(theta)

        const y =
            radius *
            Math.cos(phi)

        const marker =
            new THREE.Mesh(

                new THREE.SphereGeometry(
                    0.15,
                    16,
                    16
                ),

                new THREE.MeshBasicMaterial({
                    color: 0x00ffff
                })

            )

        marker.position.set(
            x,
            y,
            z
        )

        earth.add(marker)

        return marker

    }

    // Création des marqueurs

    const markers = []

    destinations.forEach(
        destination => {

            markers.push(

                createMarker(
                    destination.latitude,
                    destination.longitude
                )

            )

        }
    )

    // Etoiles

    const starsGeometry =
        new THREE.BufferGeometry()

    const starsCount = 5000

    const positions = []

    for (
        let i = 0;
        i < starsCount;
        i++
    ) {

        positions.push(
            (Math.random() - 0.5) * 200
        )

        positions.push(
            (Math.random() - 0.5) * 200
        )

        positions.push(
            (Math.random() - 0.5) * 200
        )

    }

    starsGeometry.setAttribute(

        'position',

        new THREE.Float32BufferAttribute(
            positions,
            3
        )

    )

    const stars =
        new THREE.Points(

            starsGeometry,

            new THREE.PointsMaterial({
                size: 0.15
            })

        )

    scene.add(stars)

    // Contrôles

    const controls =
        new OrbitControls(
            camera,
            renderer.domElement
        )

    controls.enableDamping = true

    controls.enablePan = false

    controls.minDistance = 7

    controls.maxDistance = 20

    // Animation

    function animate() {

        requestAnimationFrame(
            animate
        )

        const time =
            Date.now() * 0.003

        markers.forEach(
            (marker, index) => {

                const scale =
                    1 +
                    Math.sin(
                        time + index
                    ) * 0.25

                marker.scale.set(
                    scale,
                    scale,
                    scale
                )

            }
        )

        earth.rotation.y += 0.0008

        atmosphere.rotation.y += 0.0008

        controls.update()

        renderer.render(
            scene,
            camera
        )

    }

    animate()

    // Responsive

    window.addEventListener(
        'resize',
        () => {

            camera.aspect =
                container.value.clientWidth /
                container.value.clientHeight

            camera.updateProjectionMatrix()

            renderer.setSize(
                container.value.clientWidth,
                container.value.clientHeight
            )

        }
    )

})

</script>

<template>

    <div
        ref="container"
        class="w-full h-full"
    ></div>

</template>