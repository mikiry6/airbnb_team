<script setup>

import gsap from 'gsap'
import { ref, onMounted } from 'vue'
import { defineProps } from 'vue';

import * as THREE from 'three'

import { OrbitControls }
from 'three/examples/jsm/controls/OrbitControls.js'

const container = ref(null)
const tooltip = ref(null)
const selectedCountry = ref(null)
let isAutoRotating = true
let targetQuaternion = null

// --------------Control du zoom
const showResetButton = ref(false)
let earthRef = null
let cameraRef = null

let zoomTarget = 15
// -------------------Recuperation des Pays Et info 
const props = defineProps([

    'pays'
])
// console.log(props.pays);

const destinations = props.pays.map(pays => ({

    nom: pays.pays,
    latitude: Number(pays.latitude),
    longitude: Number(pays.longitude),
    nb_hotel:pays.hotel.length

}))

// ----------------------Retour vue Normale Apres zoom
    const resetView = () => {

        selectedCountry.value = null
        zoomTarget = 15
        showResetButton.value = false

        isAutoRotating = false

        gsap.to(cameraRef.position, {

            z: 15,

            duration: 1.5,

            ease: 'power2.out'

        })

        gsap.to(earthRef.rotation, {

            x: 0,
            y: 0,
            z: 0,

            duration: 2,

            ease: 'power2.inOut',

            onComplete: () => {

                isAutoRotating = true

            }

        })

}

onMounted(() => {

    const scene =
        new THREE.Scene()

    const raycaster = new THREE.Raycaster()

    const mouse = new THREE.Vector2()


    const camera =
        new THREE.PerspectiveCamera(
            45,
            container.value.clientWidth /
            container.value.clientHeight,
            0.1,
            1000
        )
    cameraRef = camera

    camera.position.z = 15

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
    earthRef = earth

    scene.add(earth)

    // Atmosphère

    const atmosphere =
        new THREE.Mesh(

            new THREE.SphereGeometry(
                5.25,
                64,
                64
            ),

            new THREE.MeshBasicMaterial({

                color: 0x4da6ff,

                transparent: true,

                opacity: 0.15,

                side: THREE.BackSide

            })

        )

    earth.add(atmosphere)

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

        const ring =
        new THREE.Mesh(

            new THREE.RingGeometry(
                0.2,
                0.25,
                32
            ),

            new THREE.MeshBasicMaterial({

                color: 0x00ffff,

                transparent: true,

                opacity: 0.8,

                side: THREE.DoubleSide

            })

        )

        ring.position.copy(
            marker.position
        )

        ring.lookAt(
            marker.position
                .clone()
                .multiplyScalar(2)
        )

        earth.add(ring)

        earth.add(marker)

        return marker
        // return {
        //     marker,
        //     ring
        // }

    }
    // -------------Arcs Lumineux 
    function latLonToVector3(

        latitude,
        longitude,
        radius
    ) {

        const phi =
            (90 - latitude) *
            (Math.PI / 180)

        const theta =
            (longitude + 180) *
            (Math.PI / 180)

        return new THREE.Vector3(

            -(
                radius *
                Math.sin(phi) *
                Math.cos(theta)
            ),

            radius *
            Math.cos(phi),

            radius *
            Math.sin(phi) *
            Math.sin(theta)

        )

    }

    const arcAnimations = []
    function createArc(
        startLat,
        startLon,
        endLat,
        endLon
    ) {

    const start =
        latLonToVector3(
            startLat,
            startLon,
            5.05
        )

    const end =
        latLonToVector3(
            endLat,
            endLon,
            5.05
        )

    const mid =
        start.clone()
            .add(end)
            .multiplyScalar(0.5)

    mid.normalize()
        .multiplyScalar(7)

    const curve =
        new THREE.QuadraticBezierCurve3(
            start,
            mid,
            end
        )

    const points =
        curve.getPoints(50)

    const geometry =
        new THREE.BufferGeometry()
            .setFromPoints(points)

    const material =
        new THREE.LineBasicMaterial({

            color: 0x00ffff,

            transparent: true,

            opacity: 0.8

        })

        const line =
            new THREE.Line(
                geometry,
                material
            )

        earth.add(line)

        const glow =
            new THREE.Mesh(

                new THREE.SphereGeometry(
                    0.08,
                    12,
                    12
                ),

                new THREE.MeshBasicMaterial({
                    color: 0xffffff
                })

            )

        earth.add(glow)

        arcAnimations.push({

            curve,

            glow,

            progress: Math.random()

        })

        return line

    }

    // Création des marqueurs et Arcs

    const markers = []

    console.log(destinations)
    destinations.forEach(
        destination => {

            const marker =
                createMarker(
                    destination.latitude,
                    destination.longitude
                )

            marker.userData = {
                ...destination
            }

            markers.push(marker)

        }
    )

    for (
        let i = 0;
        i < destinations.length - 1;
        i++
    ) {

        createArc(

            destinations[i].latitude,
            destinations[i].longitude,

            destinations[i + 1].latitude,
            destinations[i + 1].longitude

        )

    }

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

    controls.minDistance = 8

    controls.maxDistance = 18

    // ------------------const clickableMarkers =
    const clickableMarkers = markers
    
    // ----------------------------Recentrage de l'ecran sur click Pays
  
    // -----------------------------------------------Detection du click et  Hover
   renderer.domElement.addEventListener('mousemove', (event) => {

        const rect = renderer.domElement.getBoundingClientRect()

        mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1
        mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1

        raycaster.setFromCamera(mouse, camera)

        const intersects = raycaster.intersectObjects(markers, false)

        const tooltipEl = tooltip.value
        if (!tooltipEl) return

        if (intersects.length > 0) {

            let obj = intersects[0].object

            while (obj && !obj.userData?.nom) {
                obj = obj.parent
            }

            const destination = obj?.userData

            if (!destination) return
            console.log(destination);
            
            renderer.domElement.style.cursor = 'pointer'

            tooltipEl.textContent = destination.nom
            tooltipEl.style.display = 'block'

            // tooltipEl.style.left = event.clientX + 15 + 'px'
            // tooltipEl.style.top = event.clientY + 15 + 'px'

        } else {

            renderer.domElement.style.cursor = 'default'
            tooltipEl.style.display = 'none'
        }
    })

    // ----------------------------------------------- Click

    renderer.domElement.addEventListener(
        'click',
        event => {

            const rect =
                renderer.domElement
                    .getBoundingClientRect()

            mouse.x =
                (
                    (
                        event.clientX -
                        rect.left
                    )
                    /
                    rect.width
                ) * 2 - 1

            mouse.y =
                -(
                    (
                        event.clientY -
                        rect.top
                    )
                    /
                    rect.height
                ) * 2 + 1

            raycaster.setFromCamera(
                mouse,
                camera
            )

                
            const intersects = raycaster.intersectObjects(clickableMarkers)

            if (intersects.length > 0) {

                zoomTarget = 10
                showResetButton.value = true

                const marker =
                    intersects[0].object

                // -----------Recuperation Info Pays
                const destination =
                    marker.userData
                console.log(destination);
                
                selectedCountry.value = destination

                earth.updateMatrixWorld(true)

                const worldPosition =
                    new THREE.Vector3()

                marker.getWorldPosition(
                    worldPosition
                )

                const markerDirection =
                    worldPosition
                        .clone()
                        .normalize()

                const cameraDirection =
                        new THREE.Vector3()

                    camera.getWorldDirection(
                        cameraDirection
                    )

                    cameraDirection.negate()

                const rotationDelta =
                    new THREE.Quaternion()
                        .setFromUnitVectors(
                            markerDirection,
                            cameraDirection
                        )

                targetQuaternion =
                    rotationDelta.multiply(
                        earth.quaternion.clone()
                    )
                isAutoRotating = false

                // ------------------Affichage des infos Pays
                console.log(destination.nom)

            }

        }
)
   
    // -----------------------------------------------Animation

    function animate() {

        requestAnimationFrame(
            animate
        )

        const time =
            Date.now() * 0.003

        // ----------------Calcul du Zoom sur click 
        const currentDistance =
            camera.position.distanceTo(
                controls.target
            )

        const newDistance =
            THREE.MathUtils.lerp(
                currentDistance,
                zoomTarget,
                0.05
            )

        camera.position
            .sub(controls.target)
            .normalize()
            .multiplyScalar(newDistance)
            .add(controls.target)

        // ----------------------------------------
        arcAnimations.forEach(
            arc => {

                arc.progress += 0.002

                if (
                    arc.progress > 1
                ) {

                    arc.progress = 0

                }

                const position =
                    arc.curve.getPoint(
                        arc.progress
                    )

                arc.glow.position.copy(
                    position
                )

            }
        )

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

        // ------------Rotation de la Terre
        if (isAutoRotating) {

            earth.rotation.y += 0.0008
            earth.updateMatrixWorld(true)

        }
        else if (targetQuaternion) {

            earth.quaternion.slerp(
                targetQuaternion,
                0.05
            )

        }
        // ------------------------------
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

    <button
        v-if="showResetButton"
        @click="resetView"
        class="
            fixed
            top-5
            right-5
            z-50
            bg-cyan-500
            text-white
            px-4
            py-2
            rounded-lg
            shadow-lg
        "
    >
    Retour au globe
    </button>
    <!-- Affichage Card Info Pays -->
     <div
        v-if="selectedCountry"
        class="
            fixed
            left-10
            top-10
            z-50
            w-80
            bg-slate-900/60
            backdrop-blur-xl
            text-white
            rounded-2xl
            p-5
            shadow-2xl
            border border-white/10
            transition-all
            duration-300
        "
    >
        <div class="mb-4">
            <h2 class="text-2xl font-bold tracking-tight text-white/95">
                {{ selectedCountry.nom }}
            </h2>
            <div class="h-0.5 w-12 bg-cyan-400 rounded mt-1.5 opacity-80"></div>
        </div>

        <div class="space-y-3">
            
            <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">🏨</span>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Hôtels</p>
                        <p class="text-sm font-semibold text-white/90">{{ selectedCountry.nb_hotel }} disponibles</p>
                    </div>
                </div>
                <span class="text-xs font-semibold text-emerald-400 bg-emerald-500/10 px-2.5 py-1 rounded-lg border border-emerald-500/20">
                    5$ - 15$ <span class="text-[10px] text-emerald-400/70 font-normal">/nuit</span>
                </span>
            </div>

            <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">🏠</span>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Logements</p>
                        <p class="text-sm font-semibold text-white/90">5 disponibles</p>
                    </div>
                </div>
                <span class="text-xs font-semibold text-cyan-400 bg-cyan-500/10 px-2.5 py-1 rounded-lg border border-cyan-500/20">
                    5$ - 15$ <span class="text-[10px] text-cyan-400/70 font-normal">/mois</span>
                </span>
            </div>

        </div>
    </div>

    <!-- Pop Up nom Pays  -->
    <div
        ref="tooltip"
        style="
            position: fixed;
            pointer-events: none;
            top: 200px;
            left: 200px;
            background: red;
            color: white;
            padding: 10px;
            z-index: 99999;
            display: none;
        "
    >
    </div>

</template>
