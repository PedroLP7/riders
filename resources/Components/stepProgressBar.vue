<script setup>
import { defineProps, ref, computed } from 'vue';
import iconDone from './icons/iconDone.vue'
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
    if (data.value.currentStep < 3) { }
    data.value.currentStep++;
};

const previousStep = () => {
    if (data.value.currentStep > 0) {
        data.value.currentStep--;
    }
};
const stepZero = () => {
    
        data.value.currentStep = 0;
    
};


defineExpose({
    nextStep,
    previousStep,
    stepZero,
})

</script>
<template>
    <div class="steps-container" :style="cssStyle">
        <ul class="steps-list">
            <li class="step" v-for="(step, index) in data.steps" :key="index" :class="(index == data.currentStep) ?
        'step-active' : '', (index < data.currentStep) ? 'step-done' : ''">
                <div class="step-bubble">
                    <div class="step-count">{{ index + 1 }}</div>
                    <iconDone />
                </div>
               

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

.step-done-icon {
    display: none;
    color: #fff;
    width: 30px;
    height: 30px;
}

.step-done .step-done-icon {
    display: block;
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

.step-count {
    color: #fff;
    font-weight: 500;
    font-size: 20px;
    display: none;
}
.step-active .step-count{
    display: block;
}

</style>