<script setup>
import { defineProps, ref, computed } from 'vue';
const props = defineProps({
    data: Object,
});
props.data.currentStep--;

const data = ref(props.data)
const cssStyle = computed(() => {
    return {
        '--active-color': data.value.activeColor,
        '--passive-color': data.value.passiveColor,
    };
})
const nextStep = () => {
    if (data.value.currentStep < data.value.steps.length) { }
    data.value.currentStep++;
};

const previousStep = () => {
    if (data.value.currentStep > 0) {
        data.value.currentStep--;
    }
};

defineExpose({
    nextStep,
    previousStep
})

</script>
<template>
    <div class="steps-container" :style="cssStyle">
        <ul class="steps-list">
            <li class="step" v-for="(step, index) in data.steps" :key="index" :class="(index == data.currentStep) ?
        'step-active' : '', (index < data.currentStep) ? 'step-done' : ''">
                <div class="step-bubble" v-if="index == 0">Provider</div>
                <div class="step-bubble" v-if="index == 1">Menu</div>
                <div class="step-bubble" v-if="index == 2">Confirmacion</div>
                <div class="step-line"></div>
                <div class="line-fill"></div>
            </li>
        </ul>
    </div>
</template>

<style scoped>
.steps-container {
    width: 100%;
    margin: 0 auto;
}

.steps-list {
    display: flex;
    List-style: none;
}

.step {
    display: flex;
    align-items: center;
    flex-grow: 1;
    max-width: 100%;
    position: relative;
    height: 60px;
}

.step:last-child {
    max-width: 60px;
}

.step-bubble {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: var(--passive-color);
    transition: all .3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-line {
    width: 100%;
    height: 5px;
    background-color: var(--passive-color);
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    z-index: -10;
    justify-content: center;
}

.line-fill {
    width: 0;
    height: 5px;
    background-color: var(--active-color);
    transition: all .3s ease;
}

.step-active .step-bubble {
    width: 60px;
    height: 60px;
    background-color: var(--active-color);
}

.step-done .step-bubble {
    width: 70px;
    height: 60px;
    background-color: var(--active-color);
}

.step-done .line-fill {
    width: 100%;
}
</style>